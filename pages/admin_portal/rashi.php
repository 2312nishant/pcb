<div class="container-fluid">
    <div class="block-header" style="display:none">
        <h2>FORM EXAMPLES</h2>
    </div>

    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Add Rashi
                    </h2>

                </div>
                <div class="body">
                    <form ng-submit="savePcbRashi()" name="pcbRashiFrom">


                        <label><h4>मेष <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="aries"  ng-model="rashi.aries" class="form-control"
                                       placeholder="Enter your rashi here" required="required">

                            </div>
                            <span style="color:red" ng-show = "pcbRashiFrom.aries.$error.required">This field is required.</span>
                        </div>

                        <label><h4>वृषभ <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="taurus"  ng-model="rashi.taurus" class="form-control"
                                       placeholder="Enter your rashi here" required="required">
                            </div>
                            <span style="color:red" ng-show = "pcbRashiFrom.taurus.$error.required">This field is required.</span>
                        </div>

                        <label><h4>मिथुन <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="gemini"  ng-model="rashi.gemini" class="form-control"
                                       placeholder="Enter your rashi here" required="required">
                            </div>
							<span style="color:red" ng-show = "pcbRashiFrom.gemini.$error.required">This field is required.</span>
                        </div>

                        <label><h4>कर्क <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cancer"  ng-model="rashi.cancer" class="form-control"
                                       placeholder="Enter your rashi here" required="required">
                            </div>
							<span style="color:red" ng-show = "pcbRashiFrom.cancer.$error.required">This field is required.</span>
                        </div>


                        <label><h4>सिंह <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="lion"  ng-model="rashi.lion" class="form-control"
                                       placeholder="Enter your rashi here" required="required">
                            </div>
							<span style="color:red" ng-show = "pcbRashiFrom.lion.$error.required">This field is required.</span>
                        </div>

                        <label><h4>कन्या <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="kanya"  ng-model="rashi.kanya" class="form-control"
                                       placeholder="Enter your rashi here" required="required">
                            </div>
							<span style="color:red" ng-show = "pcbRashiFrom.kanya.$error.required">This field is required.</span>
                        </div>

                        <label><h4>तूळ <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="libra"  ng-model="rashi.libra" class="form-control"
                                       placeholder="Enter your rashi here" required="required">
                            </div>
							<span style="color:red" ng-show = "pcbRashiFrom.libra.$error.required">This field is required.</span>
                        </div>

                        <label><h4>वृश्चिक <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="scorpio"  ng-model="rashi.scorpio" class="form-control"
                                       placeholder="Enter your rashi here" required="required">
                            </div>
							<span style="color:red" ng-show = "pcbRashiFrom.scorpio.$error.required">This field is required.</span>
                        </div>


                        <label><h4>धनु <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="sagittarius"  ng-model="rashi.sagittarius" class="form-control"
                                       placeholder="Enter your rashi here" required="required">
                            </div>
							<span style="color:red" ng-show = "pcbRashiFrom.sagittarius.$error.required">This field is required.</span>
                        </div>

                        <label><h4>मकर <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="capricorn"  ng-model="rashi.capricorn" class="form-control"
                                       placeholder="Enter your rashi here" required="required">
                            </div>
							<span style="color:red" ng-show = "pcbRashiFrom.capricorn.$error.required">This field is required.</span>
                        </div>

                        <label><h4>कुंभ <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="aquarius"  ng-model="rashi.aquarius" class="form-control"
                                       placeholder="Enter your rashi here" required="required">
                            </div>
							<span style="color:red" ng-show = "pcbRashiFrom.aquarius.$error.required">This field is required.</span>
                        </div>

                        <label><h4>मीन <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="pisces"  ng-model="rashi.pisces" class="form-control"
                                       placeholder="Enter your rashi here" required="required">
                            </div>
							<span style="color:red" ng-show = "pcbRashiFrom.pisces.$error.required">This field is required.</span>
                        </div>


                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save
                        </button>
                        <a href="#/" class="btn btn-primary m-t-15 waves-effect">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

</div>
    