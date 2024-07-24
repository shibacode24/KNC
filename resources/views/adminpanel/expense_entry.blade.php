@extends('layout.header')
@section( 'content' )


            <div class="page-content-wrap">

                <div class="row">
                    <div class="col-md-12">

                           <div class="panel-body" style="padding:1px 5px 2px 5px;">

                            <div class="col-md-12" style="margin-top:5px;">

                                <a href="expense-master"> <button id="on" type="button" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;background-color: #d54e10; "><i
                                        class="fa fa-user"></i>Expense Masters</button>
                            </a>
                                <a href="income-billing"> <button id="on" type="button" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;background-color: #990066;"><i
                                        class="fa fa-plus"></i>Income/Billing</button>
                            </a>
                            <a href="expense-entry"> <button id="on" type="button" class="btn mjks"
                                style="color:#FFFFFF; height:30px; width:auto;background-color: #009999;"><i
                                    class="fa fa-plus"></i>Expense Entry</button>
                            </a>
                         </div>
                            </div>
                        </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12" style="text-align: center;margin-top: 5px;">
                                    <h6 class="panel-title" style="color:#FFFFFF; background-color:#009999; width:100%;height: 50%; font-size:16px;" align="center">
                                        <i class="fa fa-file-text"><label style="margin: 7px;">Expense Entry</label> </i> </h6>
                                    <!-- <a href="project_entry.html"> <button id="on" type="button" class="btn mjks"
                                        style="color:#FFFFFF; height:30px; width:auto;background-color: #006699;"><i
                                            class="fa fa-plus"></i>Project Entry</button>
                                </a> -->

                                </div>

                                <div class="col-md-11" style="margin-top: 2vh;">
                                    <div class="col-md-2">
                                        <label class="control-label">Voucher No.<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="name" placeholder="" />
                                    </div>
                                    <div class="col-md-5"></div>

                                    <div class="col-md-2">
                                        <label class="control-label">Select Firm<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true">
                                            <option>Firm 1</option>
                                            <option>Firm 2</option>
                                            <option>Firm 3</option>

                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Select Project<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true">
                                            <option>Firm 1</option>
                                            <option>Firm 2</option>
                                            <option>Firm 3</option>

                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Expense Category<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true">
                                            <option>Category 1</option>
                                                    <option>Category 2</option>
                                                    <option>Category 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Expense Head<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true">
                                            <option>Head 1</option>
                                            <option>Head 2</option>
                                            <option>Head 3</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3" style="margin-top: 2vh;"></div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Select Role<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true">
                                            <option>Other</option>
                                            <option>Vendor</option>
                                            <option>Agent</option>
                                            <option>Employee</option>

                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Select Vendor<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true">
                                            <option>Agent 1</option>
                                            <option>Agent 2</option>
                                            <option>Agent 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Select Agent<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true">
                                            <option>Agent 1</option>
                                            <option>Agent 2</option>
                                            <option>Agent 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Select Employee<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true">
                                            <option>Sharique</option>
                                            <option>Yash</option>
                                            <option>Pratik</option>

                                        </select>
                                    </div>
                                    <div class="col-md-5" style="margin-top: 2vh;">
                                        <label class="control-label">Particular<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="name" placeholder="" />
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Amount<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="name" placeholder="" />
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Mode of Payment<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true">
                                            <option>Bank NEFT/RTGS</option>
                                            <option>Online Banking</option>
                                            <option>UPI</option>
                                            <option>Bank Deposit</option>
                                            <option>Cash</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Account Number<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="name" placeholder="" />
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Cash From<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="name" placeholder="" />
                                    </div>
                                    <div class="col-md-8" style="margin-top: 2vh;">
                                        <label class="control-label">Narration<font color="#FF0000">*</font></label>
                                        <textarea rows="4" cols="10" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-4" style="margin-top:6vh;margin-bottom: 1vh;" align="left">

                                        <a> <button id="on" type="button" class="btn mjks"
                                         style="color:#FFFFFF; height:30px; width:auto;background-color: #006699;">
                                         <i class="fa fa-money" aria-hidden="true"></i>Pay</button></a>

                                  </div>
                                </div>





                                 </div>


                    </div>

                </div>


                <!-- START DEFAULT DATATABLE -->


            </div>



        </div>

        <!-- PAGE CONTENT WRAPPER -->


    </div>
    <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->

   @endsection
