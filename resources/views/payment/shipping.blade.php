@extends('layout.base')
@section('content')
    <!-- shipping method -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="inner-wrapper border-box">
                        <!-- navbar -->
                        <div class="justify-content-between nav mb-5">
                            <a href="" class="text-center d-inline-block active nav-item">
                                <i class="ti-truck d-block mb-2"></i>
                                <span class="d-block h4">Shipping Method</span>
                            </a>
                            <a href="{{route('payment')}}" class="text-center d-inline-block nav-item">
                                <i class="ti-wallet d-block mb-2"></i>
                                <span class="d-block h4">Payment Method</span>
                            </a>
                            <a href="{{route('review')}}" class="text-center d-inline-block nav-item">
                                <i class="ti-eye d-block mb-2"></i>
                                <span class="d-block h4">Review</span>
                            </a>
                        </div>
                        <!-- /navbar -->

                        <!-- shipping-address -->
                        <h3 class="mb-5 border-bottom pb-2">Shipping Address</h3>
                        <form action="#" class="row">
                            <div class="col-sm-6">
                                <label for="firstName">First Name</label>
                                <input class="form-control" type="text" id="firstName" name="firstName" required="">
                            </div>
                            <div class="col-sm-6">
                                <label for="lastName">Last Name</label>
                                <input class="form-control" type="text" id="lastName" name="lastName" required="">
                            </div>
                            <div class="col-sm-6">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" id="email" name="email" required="">
                            </div>
                            <div class="col-sm-6">
                                <label for="company">Company</label>
                                <input class="form-control" type="text" id="company" name="company" required="">
                            </div>
                            <div class="col-sm-6">
                                <label for="address">Address</label>
                                <input class="form-control" type="text" id="address" name="address" required="">
                            </div>
                            <div class="col-sm-6">
                                <label for="phone">Phone</label>
                                <input class="form-control" type="text" id="phone" name="phone" required="">
                            </div>
                            <div class="col-sm-6">
                                <label for="country">Country</label>
                                <select class="form-control" name="country" style="display: none;">
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Åland Islands">Åland Islands</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antarctica">Antarctica</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Bouvet Island">Bouvet Island</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of
                                        The</option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote D&#39;ivoire">Cote D'ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Territories">French Southern Territories</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guernsey">Guernsey</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-bissau">Guinea-bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Isle of Man">Isle of Man</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jersey">Jersey</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea, Democratic People&#39;s Republic of">Korea, Democratic People's
                                        Republic of</option>
                                    <option value="Korea, Republic of">Korea, Republic of</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Lao People&#39;s Democratic Republic">Lao People's Democratic Republic</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macao">Macao</option>
                                    <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former
                                        Yugoslav Republic of</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Pitcairn">Pitcairn</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Reunion">Reunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russian Federation">Russian Federation</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Helena">Saint Helena</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Georgia and The South Sandwich Islands">South Georgia and The
                                        South Sandwich Islands</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                    <option value="Swaziland">Swaziland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-leste">Timor-leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="United States Minor Outlying Islands">United States Minor Outlying
                                        Islands</option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Viet Nam">Viet Nam</option>
                                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                    <option value="Western Sahara">Western Sahara</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </select><div class="nice-select form-control" tabindex="0"><span class="current">Afghanistan</span><ul class="list"><li data-value="Afghanistan" class="option selected">Afghanistan</li><li data-value="Åland Islands" class="option">Åland Islands</li><li data-value="Albania" class="option">Albania</li><li data-value="Algeria" class="option">Algeria</li><li data-value="American Samoa" class="option">American Samoa</li><li data-value="Andorra" class="option">Andorra</li><li data-value="Angola" class="option">Angola</li><li data-value="Anguilla" class="option">Anguilla</li><li data-value="Antarctica" class="option">Antarctica</li><li data-value="Antigua and Barbuda" class="option">Antigua and Barbuda</li><li data-value="Argentina" class="option">Argentina</li><li data-value="Armenia" class="option">Armenia</li><li data-value="Aruba" class="option">Aruba</li><li data-value="Australia" class="option">Australia</li><li data-value="Austria" class="option">Austria</li><li data-value="Azerbaijan" class="option">Azerbaijan</li><li data-value="Bahamas" class="option">Bahamas</li><li data-value="Bahrain" class="option">Bahrain</li><li data-value="Bangladesh" class="option">Bangladesh</li><li data-value="Barbados" class="option">Barbados</li><li data-value="Belarus" class="option">Belarus</li><li data-value="Belgium" class="option">Belgium</li><li data-value="Belize" class="option">Belize</li><li data-value="Benin" class="option">Benin</li><li data-value="Bermuda" class="option">Bermuda</li><li data-value="Bhutan" class="option">Bhutan</li><li data-value="Bolivia" class="option">Bolivia</li><li data-value="Bosnia and Herzegovina" class="option">Bosnia and Herzegovina</li><li data-value="Botswana" class="option">Botswana</li><li data-value="Bouvet Island" class="option">Bouvet Island</li><li data-value="Brazil" class="option">Brazil</li><li data-value="British Indian Ocean Territory" class="option">British Indian Ocean Territory</li><li data-value="Brunei Darussalam" class="option">Brunei Darussalam</li><li data-value="Bulgaria" class="option">Bulgaria</li><li data-value="Burkina Faso" class="option">Burkina Faso</li><li data-value="Burundi" class="option">Burundi</li><li data-value="Cambodia" class="option">Cambodia</li><li data-value="Cameroon" class="option">Cameroon</li><li data-value="Canada" class="option">Canada</li><li data-value="Cape Verde" class="option">Cape Verde</li><li data-value="Cayman Islands" class="option">Cayman Islands</li><li data-value="Central African Republic" class="option">Central African Republic</li><li data-value="Chad" class="option">Chad</li><li data-value="Chile" class="option">Chile</li><li data-value="China" class="option">China</li><li data-value="Christmas Island" class="option">Christmas Island</li><li data-value="Cocos (Keeling) Islands" class="option">Cocos (Keeling) Islands</li><li data-value="Colombia" class="option">Colombia</li><li data-value="Comoros" class="option">Comoros</li><li data-value="Congo" class="option">Congo</li><li data-value="Congo, The Democratic Republic of The" class="option">Congo, The Democratic Republic of
                                            The</li><li data-value="Cook Islands" class="option">Cook Islands</li><li data-value="Costa Rica" class="option">Costa Rica</li><li data-value="Cote D&#39;ivoire" class="option">Cote D'ivoire</li><li data-value="Croatia" class="option">Croatia</li><li data-value="Cuba" class="option">Cuba</li><li data-value="Cyprus" class="option">Cyprus</li><li data-value="Czech Republic" class="option">Czech Republic</li><li data-value="Denmark" class="option">Denmark</li><li data-value="Djibouti" class="option">Djibouti</li><li data-value="Dominica" class="option">Dominica</li><li data-value="Dominican Republic" class="option">Dominican Republic</li><li data-value="Ecuador" class="option">Ecuador</li><li data-value="Egypt" class="option">Egypt</li><li data-value="El Salvador" class="option">El Salvador</li><li data-value="Equatorial Guinea" class="option">Equatorial Guinea</li><li data-value="Eritrea" class="option">Eritrea</li><li data-value="Estonia" class="option">Estonia</li><li data-value="Ethiopia" class="option">Ethiopia</li><li data-value="Falkland Islands (Malvinas)" class="option">Falkland Islands (Malvinas)</li><li data-value="Faroe Islands" class="option">Faroe Islands</li><li data-value="Fiji" class="option">Fiji</li><li data-value="Finland" class="option">Finland</li><li data-value="France" class="option">France</li><li data-value="French Guiana" class="option">French Guiana</li><li data-value="French Polynesia" class="option">French Polynesia</li><li data-value="French Southern Territories" class="option">French Southern Territories</li><li data-value="Gabon" class="option">Gabon</li><li data-value="Gambia" class="option">Gambia</li><li data-value="Georgia" class="option">Georgia</li><li data-value="Germany" class="option">Germany</li><li data-value="Ghana" class="option">Ghana</li><li data-value="Gibraltar" class="option">Gibraltar</li><li data-value="Greece" class="option">Greece</li><li data-value="Greenland" class="option">Greenland</li><li data-value="Grenada" class="option">Grenada</li><li data-value="Guadeloupe" class="option">Guadeloupe</li><li data-value="Guam" class="option">Guam</li><li data-value="Guatemala" class="option">Guatemala</li><li data-value="Guernsey" class="option">Guernsey</li><li data-value="Guinea" class="option">Guinea</li><li data-value="Guinea-bissau" class="option">Guinea-bissau</li><li data-value="Guyana" class="option">Guyana</li><li data-value="Haiti" class="option">Haiti</li><li data-value="Heard Island and Mcdonald Islands" class="option">Heard Island and Mcdonald Islands</li><li data-value="Holy See (Vatican City State)" class="option">Holy See (Vatican City State)</li><li data-value="Honduras" class="option">Honduras</li><li data-value="Hong Kong" class="option">Hong Kong</li><li data-value="Hungary" class="option">Hungary</li><li data-value="Iceland" class="option">Iceland</li><li data-value="India" class="option">India</li><li data-value="Indonesia" class="option">Indonesia</li><li data-value="Iran, Islamic Republic of" class="option">Iran, Islamic Republic of</li><li data-value="Iraq" class="option">Iraq</li><li data-value="Ireland" class="option">Ireland</li><li data-value="Isle of Man" class="option">Isle of Man</li><li data-value="Israel" class="option">Israel</li><li data-value="Italy" class="option">Italy</li><li data-value="Jamaica" class="option">Jamaica</li><li data-value="Japan" class="option">Japan</li><li data-value="Jersey" class="option">Jersey</li><li data-value="Jordan" class="option">Jordan</li><li data-value="Kazakhstan" class="option">Kazakhstan</li><li data-value="Kenya" class="option">Kenya</li><li data-value="Kiribati" class="option">Kiribati</li><li data-value="Korea, Democratic People&#39;s Republic of" class="option">Korea, Democratic People's
                                            Republic of</li><li data-value="Korea, Republic of" class="option">Korea, Republic of</li><li data-value="Kuwait" class="option">Kuwait</li><li data-value="Kyrgyzstan" class="option">Kyrgyzstan</li><li data-value="Lao People&#39;s Democratic Republic" class="option">Lao People's Democratic Republic</li><li data-value="Latvia" class="option">Latvia</li><li data-value="Lebanon" class="option">Lebanon</li><li data-value="Lesotho" class="option">Lesotho</li><li data-value="Liberia" class="option">Liberia</li><li data-value="Libyan Arab Jamahiriya" class="option">Libyan Arab Jamahiriya</li><li data-value="Liechtenstein" class="option">Liechtenstein</li><li data-value="Lithuania" class="option">Lithuania</li><li data-value="Luxembourg" class="option">Luxembourg</li><li data-value="Macao" class="option">Macao</li><li data-value="Macedonia, The Former Yugoslav Republic of" class="option">Macedonia, The Former
                                            Yugoslav Republic of</li><li data-value="Madagascar" class="option">Madagascar</li><li data-value="Malawi" class="option">Malawi</li><li data-value="Malaysia" class="option">Malaysia</li><li data-value="Maldives" class="option">Maldives</li><li data-value="Mali" class="option">Mali</li><li data-value="Malta" class="option">Malta</li><li data-value="Marshall Islands" class="option">Marshall Islands</li><li data-value="Martinique" class="option">Martinique</li><li data-value="Mauritania" class="option">Mauritania</li><li data-value="Mauritius" class="option">Mauritius</li><li data-value="Mayotte" class="option">Mayotte</li><li data-value="Mexico" class="option">Mexico</li><li data-value="Micronesia, Federated States of" class="option">Micronesia, Federated States of</li><li data-value="Moldova, Republic of" class="option">Moldova, Republic of</li><li data-value="Monaco" class="option">Monaco</li><li data-value="Mongolia" class="option">Mongolia</li><li data-value="Montenegro" class="option">Montenegro</li><li data-value="Montserrat" class="option">Montserrat</li><li data-value="Morocco" class="option">Morocco</li><li data-value="Mozambique" class="option">Mozambique</li><li data-value="Myanmar" class="option">Myanmar</li><li data-value="Namibia" class="option">Namibia</li><li data-value="Nauru" class="option">Nauru</li><li data-value="Nepal" class="option">Nepal</li><li data-value="Netherlands" class="option">Netherlands</li><li data-value="Netherlands Antilles" class="option">Netherlands Antilles</li><li data-value="New Caledonia" class="option">New Caledonia</li><li data-value="New Zealand" class="option">New Zealand</li><li data-value="Nicaragua" class="option">Nicaragua</li><li data-value="Niger" class="option">Niger</li><li data-value="Nigeria" class="option">Nigeria</li><li data-value="Niue" class="option">Niue</li><li data-value="Norfolk Island" class="option">Norfolk Island</li><li data-value="Northern Mariana Islands" class="option">Northern Mariana Islands</li><li data-value="Norway" class="option">Norway</li><li data-value="Oman" class="option">Oman</li><li data-value="Pakistan" class="option">Pakistan</li><li data-value="Palau" class="option">Palau</li><li data-value="Palestinian Territory, Occupied" class="option">Palestinian Territory, Occupied</li><li data-value="Panama" class="option">Panama</li><li data-value="Papua New Guinea" class="option">Papua New Guinea</li><li data-value="Paraguay" class="option">Paraguay</li><li data-value="Peru" class="option">Peru</li><li data-value="Philippines" class="option">Philippines</li><li data-value="Pitcairn" class="option">Pitcairn</li><li data-value="Poland" class="option">Poland</li><li data-value="Portugal" class="option">Portugal</li><li data-value="Puerto Rico" class="option">Puerto Rico</li><li data-value="Qatar" class="option">Qatar</li><li data-value="Reunion" class="option">Reunion</li><li data-value="Romania" class="option">Romania</li><li data-value="Russian Federation" class="option">Russian Federation</li><li data-value="Rwanda" class="option">Rwanda</li><li data-value="Saint Helena" class="option">Saint Helena</li><li data-value="Saint Kitts and Nevis" class="option">Saint Kitts and Nevis</li><li data-value="Saint Lucia" class="option">Saint Lucia</li><li data-value="Saint Pierre and Miquelon" class="option">Saint Pierre and Miquelon</li><li data-value="Saint Vincent and The Grenadines" class="option">Saint Vincent and The Grenadines</li><li data-value="Samoa" class="option">Samoa</li><li data-value="San Marino" class="option">San Marino</li><li data-value="Sao Tome and Principe" class="option">Sao Tome and Principe</li><li data-value="Saudi Arabia" class="option">Saudi Arabia</li><li data-value="Senegal" class="option">Senegal</li><li data-value="Serbia" class="option">Serbia</li><li data-value="Seychelles" class="option">Seychelles</li><li data-value="Sierra Leone" class="option">Sierra Leone</li><li data-value="Singapore" class="option">Singapore</li><li data-value="Slovakia" class="option">Slovakia</li><li data-value="Slovenia" class="option">Slovenia</li><li data-value="Solomon Islands" class="option">Solomon Islands</li><li data-value="Somalia" class="option">Somalia</li><li data-value="South Africa" class="option">South Africa</li><li data-value="South Georgia and The South Sandwich Islands" class="option">South Georgia and The
                                            South Sandwich Islands</li><li data-value="Spain" class="option">Spain</li><li data-value="Sri Lanka" class="option">Sri Lanka</li><li data-value="Sudan" class="option">Sudan</li><li data-value="Suriname" class="option">Suriname</li><li data-value="Svalbard and Jan Mayen" class="option">Svalbard and Jan Mayen</li><li data-value="Swaziland" class="option">Swaziland</li><li data-value="Sweden" class="option">Sweden</li><li data-value="Switzerland" class="option">Switzerland</li><li data-value="Syrian Arab Republic" class="option">Syrian Arab Republic</li><li data-value="Taiwan, Province of China" class="option">Taiwan, Province of China</li><li data-value="Tajikistan" class="option">Tajikistan</li><li data-value="Tanzania, United Republic of" class="option">Tanzania, United Republic of</li><li data-value="Thailand" class="option">Thailand</li><li data-value="Timor-leste" class="option">Timor-leste</li><li data-value="Togo" class="option">Togo</li><li data-value="Tokelau" class="option">Tokelau</li><li data-value="Tonga" class="option">Tonga</li><li data-value="Trinidad and Tobago" class="option">Trinidad and Tobago</li><li data-value="Tunisia" class="option">Tunisia</li><li data-value="Turkey" class="option">Turkey</li><li data-value="Turkmenistan" class="option">Turkmenistan</li><li data-value="Turks and Caicos Islands" class="option">Turks and Caicos Islands</li><li data-value="Tuvalu" class="option">Tuvalu</li><li data-value="Uganda" class="option">Uganda</li><li data-value="Ukraine" class="option">Ukraine</li><li data-value="United Arab Emirates" class="option">United Arab Emirates</li><li data-value="United Kingdom" class="option">United Kingdom</li><li data-value="United States" class="option">United States</li><li data-value="United States Minor Outlying Islands" class="option">United States Minor Outlying
                                            Islands</li><li data-value="Uruguay" class="option">Uruguay</li><li data-value="Uzbekistan" class="option">Uzbekistan</li><li data-value="Vanuatu" class="option">Vanuatu</li><li data-value="Venezuela" class="option">Venezuela</li><li data-value="Viet Nam" class="option">Viet Nam</li><li data-value="Virgin Islands, British" class="option">Virgin Islands, British</li><li data-value="Virgin Islands, U.S." class="option">Virgin Islands, U.S.</li><li data-value="Wallis and Futuna" class="option">Wallis and Futuna</li><li data-value="Western Sahara" class="option">Western Sahara</li><li data-value="Yemen" class="option">Yemen</li><li data-value="Zambia" class="option">Zambia</li><li data-value="Zimbabwe" class="option">Zimbabwe</li></ul></div>
                            </div>
                            <div class="col-sm-6">
                                <label for="city">City</label>
                                <select class="form-control" name="city" style="display: none;">
                                    <option value="brown">Dhaka</option>
                                    <option value="gray">Newyork</option>
                                    <option value="black">Delhi</option>
                                </select><div class="nice-select form-control" tabindex="0"><span class="current">Dhaka</span><ul class="list"><li data-value="brown" class="option selected">Dhaka</li><li data-value="gray" class="option">Newyork</li><li data-value="black" class="option">Delhi</li></ul></div>
                            </div>
                            <div class="col-sm-6">
                                <label for="zip-code">Zip Code</label>
                                <input class="form-control" type="text" id="zip-code" name="zip-code" required="">
                            </div>
                            <div class="col-sm-6">
                                <label for="fax">Fax</label>
                                <input class="form-control" type="text" id="fax" name="fax" required="">
                            </div>

                            <!-- select shipping method -->
                            <div class="col-12">
                                <h3 class="mb-5 border-bottom pb-2">Select A Shipping Method</h3>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <input id="standard" class="custom-checkbox" type="radio" name="checkbox" value="1" checked="checked">
                                <label for="standard">Standard Ground (USPS) - $7.50</label>
                                <small class="d-block ml-3">Delivered in 8-12 business days.</small>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <input id="premium" type="radio" name="checkbox" value="2">
                                <label for="premium">Premium Ground (UPS) - $12.50</label>
                                <small class="d-block ml-3">Delivered in 4-7 business days.</small>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <input id="ups2" type="radio" name="checkbox" value="3">
                                <label for="ups2">UPS 2 Business Day - $15.00</label>
                                <small class="d-block ml-3">Orders placed by 9:45AM PST will ship same day.</small>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <input id="ups1" type="radio" name="checkbox" value="4">
                                <label for="ups1">UPS 1 Business Day - $35.00</label>
                                <small class="d-block ml-3">Orders placed by 9:45AM PST will ship same day.</small>
                            </div>
                            <!-- /select shipping method -->
                        </form>
                        <!-- /shipping-address -->
                        <div class="p-4 bg-gray text-right">
                            <a href="{{route('payment')}}" class="btn btn-primary">Continue</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border-box p-4">
                        <h4>Order Summery</h4>
                        <p>Excepteur sint occaecat cupidat non proi dent sunt.officia.</p>
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between">
                                <span>Subtotal</span>
                                <span>$237.00</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>Shipping &amp; Handling</span>
                                <span>$15.00</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>Estimated Tax</span>
                                <span>$0.00</span>
                            </li>
                        </ul>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Total</span>
                            <strong>USD $253.00</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /shipping method -->
@endsection
