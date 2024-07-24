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
                                    <h6 class="panel-title" style="color:#FFFFFF; background-color:#990066; width:100%;height: 50%; font-size:16px;" align="center">
                                        <i class="fa fa-file-text"><label style="margin: 7px;">Income/Billing</label> </i> </h6>


                                </div>

                                <div class="col-md-12" style="margin-top: 2vh;">
                                    <div class="col-md-2">
                                        <label class="control-label">Bill No.<font color="#FF0000">*</font></label>
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
                                        <label class="control-label">Income Category<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true">
                                            <option>Client</option>
                                                    <option>Loan </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Client List<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true">
                                            <option>Client 1</option>
                                            <option>Client 2</option>
                                            <option>Client 3</option>

                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 1vh;">
                                        <label class="control-label">Plot No: <font color="#ff0000">11
                                        </font></label>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 1vh;">
                                        <label class="control-label">Total Cost: <font color="#ff0000">1,10,00000
                                        </font></label>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 1vh;">
                                        <label class="control-label">Paid Amount: <font color="#ff0000">10
                                        </font></label>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 1vh;">
                                        <label class="control-label">Balance Amount: <font color="#ff0000">5
                                        </font></label>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 1vh;">
                                        <label class="control-label">Total EMI : <font color="#ff0000">0
                                        </font></label>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 1vh;">
                                        <label class="control-label">Paid EMI: <font color="#ff0000">0.00
                                        </font></label>
                                    </div>
                                    <div class="col-md-1" style="margin-top: 1vh;">
                                        <label class="control-label">Due EMI: <font color="#ff0000">1100
                                        </font></label>
                                    </div>
                                    <div class="col-md-1" style="margin-top: 1vh;">
                                        <label class="control-label">Panelty: <font color="#ff0000">1100
                                        </font></label>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 1vh;">
                                        <label class="control-label">Other Charges: <font color="#ff0000">1100
                                        </font></label>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 5pxh;"></div>

                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Bank<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="name" placeholder="" />
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Amount<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="name" placeholder="" />
                                    </div>
                                    <div class="col-md-2" style="margin-top: 2vh;">
                                        <label class="control-label">Remarks<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="name" placeholder="" />
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-8" style="margin-top: 5px;">
                                            <div class="col-md-2" style="margin-top: 2vh;">
                                                <label class="control-label">EMI No<font color="#FF0000">*</font></label>
                                                <select class="form-control select" data-live-search="true">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>

                                                </select>
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
                                                <label class="control-label">Attach Proof<font color="#FF0000">*</font></label>
                                                <input type="file" class="form-control" name="name" placeholder="" />
                                            </div>
                                            <div class="col-md-6" style="margin-top: 2vh;">
                                                <label class="control-label">Narration<font color="#FF0000">*</font></label>
                                                <textarea rows="2" cols="10" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-4" style="margin-top:6vh;margin-bottom: 1vh;" align="left">

                                                <a> <button id="on" type="button" class="btn mjks"
                                                 style="color:#FFFFFF; height:30px; width:auto;background-color: #006699;">
                                                 <i class="fa fa-print" aria-hidden="true"></i>Receipt & Print</button></a>
                                                 <!-- <a> <button id="on" type="button" class="btn mjks"
                                                    style="color:#FFFFFF; height:30px; width:auto;background-color: #006699;">
                                                    <i class="fa fa-print" aria-hidden="true"></i>Print</button></a> -->
                                          </div>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 5vh;float: left;margin-left: -25vh;">
                                            <!-- <table width="100%"  border="1" style="margin-top: 5px;overflow: auto;">
                                                <thead>
                                                    <tr style="background-color:#f0f0f0; height:30px;">
                                                        <th width="10%" style="text-align:center">Sr.No</th>
                                                        <th width="10%" style="text-align:center">EMI No</th>
                                                        <th width="10%" style="text-align:center">Date of Payment</th>
                                                        <th width="10%" style="text-align:center">Amount</th>
                                                        <th width="10%" style="text-align:center">Status</th>
                                                    </tr>
                                                </thead>
                                               <tbody>

                                                <tr>
                                                    <td width="25%" style="padding:5px;" align="center">
                                                        <label>1</label>
                                                    </td>
                                                    <td  style="padding:5px;" align="center">
                                                        <label>1</label>
                                                    </td>
                                                    <td style="padding:5px;" align="center">
                                                        <label>1</label>
                                                    </td>
                                                    <td style="padding:5px;" align="center">
                                                        <label>1</label>
                                                    </td>


                                                    <td style="padding:5px;" align="center">
                                                        <label>1</label>
                                                    </td>
                                                </tr>
                                               </tbody>


                                            </table> -->

                                            <div class="container">
                                                <table width="100%">
                                                  <thead>
                                                    <tr>
                                                      <th>EMI No</th>
                                                      <th>Date of Payment</th>
                                                      <th>Amount</th>
                                                      <th>Status</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <td>1</td>
                                                      <td>21-07-2024</td>
                                                      <td>1000</td>
                                                      <td>Paid</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>21-07-2024</td>
                                                        <td>1000</td>
                                                        <td>Paid</td>
                                                      </tr>
                                                      <tr>
                                                        <td>3</td>
                                                        <td>21-07-2024</td>
                                                        <td>1000</td>
                                                        <td>Paid</td>
                                                      </tr>
                                                      <tr>
                                                        <td>4</td>
                                                        <td>21-07-2024</td>
                                                        <td>1000</td>
                                                        <td>Paid</td>
                                                      </tr>
                                                      <tr>
                                                        <td>5</td>
                                                        <td>21-07-2024</td>
                                                        <td>1000</td>
                                                        <td>Paid</td>
                                                      </tr>
                                                      <tr>
                                                        <td>6</td>
                                                        <td>21-07-2024</td>
                                                        <td>1000</td>
                                                        <td>Paid</td>
                                                      </tr>
                                                  </tbody>
                                                </table>
                                              </div>
                                        </div>
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
