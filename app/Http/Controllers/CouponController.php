<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Services\CouponService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort ?? 'DESC';
        $limit = (int) ($request->limit ?? 10);

        $query = Coupon::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($inner) use ($q) {
                $inner->where('code', 'LIKE', "%{$q}%")
                    ->orWhere('title', 'LIKE', "%{$q}%");
            });
        }

        if ($request->blocked === 'blocked') {
            $query->where('is_blocked', true);
        } elseif ($request->blocked === 'free') {
            $query->where('is_blocked', false);
        }

        if ($request->filled('status') && in_array($request->status, [Coupon::STATUS_ACTIVE, Coupon::STATUS_INACTIVE], true)) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('id', $sort)->paginate($limit);
        $data->appends($request->only(['q', 'blocked', 'status', 'sort', 'limit']));

        return view('backend.coupons.index', compact('data'));
    }

    public function create()
    {
        return view('backend.coupons.create');
    }

    public function store(Request $request)
    {
        $request->merge(['code' => strtoupper(trim((string) $request->code))]);
        $request->validate($this->couponRules());

        $row = new Coupon;
        $this->fillCouponFromRequest($row, $request);
        $row->save();

        Session::flash('success', 'Coupon added successfully');

        return redirect()->route('coupons.index');
    }

    public function edit($id)
    {
        $data = Coupon::findOrFail($id);

        return view('backend.coupons.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $request->merge(['code' => strtoupper(trim((string) $request->code))]);
        $request->validate($this->couponRules((int) $id));

        $row = Coupon::findOrFail($id);
        $this->fillCouponFromRequest($row, $request);
        $row->save();

        Session::flash('success', 'Coupon updated successfully');

        return redirect()->route('coupons.index');
    }

    public function delete(Request $request)
    {
        $count = count($request->ids ?? []);
        if ($count > 0) {
            Coupon::destroy($request->ids);
        }
        Session::flash('success', "{$count} coupon(s) deleted");

        return redirect()->route('coupons.index');
    }

    public function validateCoupon(Request $request, CouponService $couponService)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:191',
            'subtotal' => 'nullable|numeric|min:0',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'integer',
        ]);

        $user = auth()->user();
        $subtotal = (float) ($validated['subtotal'] ?? 0);
        $productIds = $validated['product_ids'] ?? [];

        $result = $couponService->validateCouponCode(
            $validated['code'],
            $user,
            $subtotal,
            $productIds
        );

        return response()->json([
            'valid' => $result['valid'],
            'message' => $result['message'],
            'errors' => $result['errors'],
            'coupon' => $result['coupon'] ? [
                'id' => $result['coupon']->id,
                'title' => $result['coupon']->title,
                'code' => $result['coupon']->code,
                'discount_type' => $result['coupon']->discount_type,
                'discount_value' => (string) $result['coupon']->discount_value,
            ] : null,
        ]);
    }

    public function applyCoupon(Request $request, CouponService $couponService)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:191',
            'subtotal' => 'required|numeric|min:0',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'integer',
        ]);

        $user = auth()->user();
        $applied = $couponService->applyToSubtotal(
            $validated['code'],
            (float) $validated['subtotal'],
            $validated['product_ids'] ?? [],
            $user
        );

        if (! $applied['success']) {
            return response()->json([
                'success' => false,
                'message' => $applied['message'],
                'subtotal' => $applied['subtotal'],
                'discount_amount' => $applied['discount_amount'],
                'final_total' => $applied['final_total'],
            ], 422);
        }

        $coupon = $applied['coupon'];

        return response()->json([
            'success' => true,
            'message' => null,
            'subtotal' => $applied['subtotal'],
            'discount_amount' => $applied['discount_amount'],
            'final_total' => $applied['final_total'],
            'coupon' => [
                'id' => $coupon->id,
                'title' => $coupon->title,
                'code' => $coupon->code,
                'discount_type' => $coupon->discount_type,
                'discount_value' => (string) $coupon->discount_value,
            ],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function couponRules(?int $ignoreId = null): array
    {
        $uniqueCode = Rule::unique('coupons', 'code');
        if ($ignoreId !== null) {
            $uniqueCode = $uniqueCode->ignore($ignoreId);
        }

        return [
            'title' => 'required|string|max:255',
            'code' => ['required', 'string', 'max:191', $uniqueCode],
            'discount_type' => ['required', Rule::in([Coupon::DISCOUNT_PERCENTAGE, Coupon::DISCOUNT_FIXED])],
            'discount_value' => [
                'required',
                'numeric',
                'min:0',
                Rule::when(
                    request('discount_type') === Coupon::DISCOUNT_PERCENTAGE,
                    ['max:100']
                ),
            ],
            'description' => 'nullable|string',
            'show_on_website' => 'nullable',
            'status' => ['required', Rule::in([Coupon::STATUS_ACTIVE, Coupon::STATUS_INACTIVE])],
            'is_blocked' => 'nullable',
        ];
    }

    private function fillCouponFromRequest(Coupon $row, Request $request): void
    {
        $row->title = $request->title;
        $row->code = $request->code;
        $row->discount_type = $request->discount_type;
        $row->discount_value = $request->discount_value;
        $row->description = $request->description;
        $row->show_on_website = ($request->show_on_website === 'on' || $request->show_on_website == 1) ? 1 : 0;
        $row->status = $request->status;
        $row->is_blocked = ($request->is_blocked === 'on' || $request->is_blocked == 1) ? 1 : 0;
    }
}
