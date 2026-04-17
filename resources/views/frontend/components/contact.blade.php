@push('additionalStyles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.2.1/build/css/intlTelInput.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
  .iti {
    width: 100%;
  }
  #phone, select {
    border: none;
    border: 1px solid #ddd;
    color: #555;
    margin-bottom: 10px;
    height: 35px;
    padding: 5px;
    width: 100%;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -ms-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
  }
</style>
@endpush
<section id="mu-contact">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-contact-area">
           <!-- start title -->
           <div class="mu-title">
            @isset($meta['title'])
             <h2>{{$meta['title']}}</h2>
             @endisset
             @isset($meta['desc'])
             <p>{{$meta['desc']}}</p>
             @endisset
           </div>
           <!-- end title -->
           <!-- start contact content -->
           <div class="mu-contact-content">           
             <div class="row">
              @if(Session::has('success'))
              <div class="alert alert-success">
                <p>{{getConfigurations()['contact_meta']['thank_msg']??'Thank you for contacting us.'}}</p>
              </div>
              @endif
              @if ($errors->has('recaptcha'))
                    <div class="alert alert-danger">
                        <p>{{ $errors->first('recaptcha') }}</p>
                    </div>
                @endif
               <div class="{{(isset($meta['map_iframe'])?'col-md-6':'col-md-6 col-md-offset-3')}}">
                 <div class="mu-contact-left">
                   <form class="contactform" action="{{route('contactMail')}}" method="post" id="contact-form">                  
                     <p class="comment-form-author">
                       <label for="author">Full name:<span class="required">*</span></label>
                       <input type="text" required="required" size="30" value="" name="name" maxlength="50">
                       @csrf
                     </p>
                     <p class="comment-form-email">
                       <label for="email">Email address:<span class="required">*</span></label>
                       <input type="email" required="required" aria-required="true" name="email" maxlength="60">
                     </p>
                     <p class="comment-form-email">
                       <label for="Phone">Phone:<span class="required">*</span></label>
                       <input id="phone" type="tel" name="phone">
                       <input type="hidden" id="country_code" name="country_code" />
                     </p>
                     <div class="row">
                      <p class="col-md-4 comment-form-url">
                        <label for="country">Country:<span class="required">*</span></label>
                        <select name="fields_meta[country]" id="country" class="select2" required>
                         <option value="">Select Country</option>
                         @foreach(getCountries() as $cid => $country)
                         <option value="{{$country}}">{{$cid}}</option>
                          @endforeach
                        </select>
                      </p>
                      <p class="col-md-4 comment-form-url">
                        <label for="state">State:<span class="required">*</span></label>
                        {{-- <input type="text" aria-required="true" name="fields_meta[state]" required maxlength="60"> --}}
                        <select name="fields_meta[state]" id="state" class="select2" required>
                          <option value="">Select State</option>                          
                         </select>
                      </p>
                      <p class="col-md-4 comment-form-url">
                        <label for="city">City:<span class="required">*</span></label>
                        {{-- <input type="text" aria-required="true" name="fields_meta[city]" required maxlength="60"> --}}
                        <select name="fields_meta[city]" id="city" class="select2" required>
                          <option value="">Select City</option>                          
                         </select>
                      </p>                                                                                          
                     </div>
                     <p class="comment-form-email">
                       <label for="address">Street Address:<span class="required">*</span></label>
                       <input type="text" name="fields_meta[address_1]" required maxlength="80">
                     </p>
                     <div class="row">
                       <p class="col-md-8 comment-form-email">
                         <label for="address_2">Address Line 2:</label>
                         <input type="text" name="fields_meta[address_2]" maxlength="80">
                       </p>
                       <p class="col-md-4 comment-form-url">
                        <label for="postal">Zip / Postal Code:<span class="required">*</span></label>
                        <input type="text" aria-required="true" name="fields_meta[postal]" required maxlength="60">
                      </p>
                     </div>                     
                     <p class="comment-form-url">
                       <label for="subject">Subject:<span class="required">*</span></label>
                       <input type="text" required="required" aria-required="true" value="" name="subject" maxlength="100">
                     </p>
                     <p class="comment-form-comment">
                       <label for="comment">Message:<span class="required">*</span></label>
                       <textarea required="required" aria-required="true" rows="8" cols="45" name="message"></textarea>
                     </p>   
                      {{-- <div class="form-submit">
                       <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                      </div> --}}
                      {{-- <fieldset class="ant_num">
                         <img src="https://mainitsol.com/captcha/captcha.php" />
                         <br/>
                         <input type="text" name="captcha" placeholder="Enter Security Code above" />
                         <br/><br/>
                      </fieldset> --}}
                      <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                     <p class="form-submit">
                       <input type="submit" value="Send Message" class="mu-post-btn is-link" name="submit">
                     </p>        
                   </form>
                 </div>
               </div>
               @isset($meta['map_iframe'])
               <div class="col-md-6">
                 <div class="mu-contact-right">
                   {!! $meta['map_iframe'] !!}
                 </div>
               </div>
               @endisset
             </div>
           </div>
           <!-- end contact content -->
          </div>
        </div>
      </div>
    </div>
  </section>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@push('additionalScripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(".select2").select2();

  $(document).ready(function () {
    // Fetch states when a country is selected
    $('#country').on('change', function () {
      let countryId = $(this).val();
      let stateDropdown = $('#state');
      let cityDropdown = $('#city');

      stateDropdown.empty().append('<option value="">Select State</option>'); // Reset states
      cityDropdown.empty().append('<option value="">Select City</option>'); // Reset cities

      if (countryId) {
        $.ajax({
          url: `/get-states/${countryId}`,
          type: 'GET',
          success: function (states) {
            $.each(states, function (key, value) {
              stateDropdown.append(`<option value="${key}">${value}</option>`);
            });
          },
          error: function () {
            // alert('Error fetching states. Please try again.');
          },
        });
      }
    });

    // Fetch cities when a state is selected
    $('#state').on('change', function () {
      let stateId = $(this).val();
      let cityDropdown = $('#city');

      cityDropdown.empty().append('<option value="">Select City</option>'); // Reset cities

      if (stateId) {
        $.ajax({
          url: `/get-cities/${stateId}`,
          type: 'GET',
          success: function (cities) {
            $.each(cities, function (key, value) {
              cityDropdown.append(`<option value="${key}">${value}</option>`);
            });
          },
          error: function () {
            // alert('Error fetching cities. Please try again.');
          },
        });
      }
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.2.1/build/js/intlTelInput.min.js"></script>
<script>
  $(document).ready(function () {
    // Initialize intlTelInput
    const input = $("#phone");
    const countryCodeInput = $("#country_code");
    const iti = window.intlTelInput(input[0], {
      initialCountry: "us", // Set default country to USA
      separateDialCode: true, // Show dial code separately
      utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@25.2.1/build/js/utils.js", // for number formatting
    });

    // Restrict input to numbers only
    input.on("input", function () {
      const validChars = /^[0-9]*$/; // Allow only numbers
      if (!validChars.test(this.value)) {
        this.value = this.value.replace(/[^0-9]/g, ""); // Remove invalid characters
      }
    });

    // Update hidden country code field and phone field on form submission
    $("#contact-form").on("submit", function () {
      const fullNumber = iti.getNumber(); // Get the full number in E.164 format
      const countryCode = iti.getSelectedCountryData().dialCode; // Get the country code
      // input.val(fullNumber); // Set the full number in the phone input field
      countryCodeInput.val(countryCode); // Set the country code in the hidden field      
    });
  });
</script>
@endpush