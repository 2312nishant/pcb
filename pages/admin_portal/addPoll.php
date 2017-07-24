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
                        Add Voting Poll
                    </h2>

                </div>
                <div class="body">
                    <form ng-submit="savePcbPoll()" name="pcbPollFrom">
                       
                         <label><h4>Poll Question</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"  ng-model="poll.que" class="form-control"
                                       placeholder="Enter your Poll Question here">
                            </div>
                        </div>
                        
                         <label><h4>Option A</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"  ng-model="poll.optionA" class="form-control"
                                       placeholder="Enter your Options here">
                            </div>
                        </div>
                        
                         <label><h4>Option B</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"  ng-model="poll.optionB" class="form-control"
                                       placeholder="Enter your Options here">
                            </div>
                        </div>
                        
                         <label><h4>Option C</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"  ng-model="poll.optionC" class="form-control"
                                       placeholder="Enter your Options here">
                            </div>
                        </div>

 <label><h4>Option D</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"  ng-model="poll.optionD" class="form-control"
                                       placeholder="Enter your Options here">
                            </div>
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
    