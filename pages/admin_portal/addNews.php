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
                        Add News
                    </h2>

                </div>
                <div class="body">
                    <form ng-submit="addPcbNews()" name="pcbNewsFrom">
                        <label for="email_address"><h2>Select News to Add <span style="color:rgb(255,0,0)">*</span></h2>
                        </label>

                        <div class="form-group">
                            <div class="form-line">
                                <select class="form-control show-tick selectpicker" data-live-search="true" ng-model="pcbNews.type">
                                    <option></option>
                                    <option ng-repeat='news in newsType' value="{{news.id}}">{{news.display_name}}</option>

                                </select>
                            </div>
                        </div>

                        <label for="password"><h4>Enter News Title</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="title" ng-model="pcbNews.title" class="form-control"
                                       placeholder="Enter your News Title">
                            </div>
                        </div>

                        <label for="email_address"><h4>News Image <span style="color:rgb(255,0,0)">*</span></h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="file" id="newsImage" ngf-select="uploadFiles($file, $invalidFiles)"
                                        accept="image/*" ngf-max-height="1000" ngf-max-size="1MB">
                                    </input>
                            </div>
                        </div>

                        <label for="email_address"><h4>News Description <span style="color:rgb(255,0,0)">*</span></h4>
                        </label>

                        <div id="editor">
                            <textarea id='edit' ng-model="pcbNews.description" name="description" style="margin-top: 30px;" >
                            </textarea>
                        </div>
                        <br/>
                        <label for="password"><h4>Enter News Tag</h4></label>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="tag" ng-model="pcbNews.tag" class="form-control"
                                       placeholder="Enter your Hash Tag here" value=" " ng-init="pcbNews.tag=' '">
                            </div>
                        </div>


                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                        <button type="button" class="btn btn-primary m-t-15 waves-effect" ng-click="resetForm()">Clear</button>
                        <a href="#/" class="btn btn-primary m-t-15 waves-effect">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

</div>
    