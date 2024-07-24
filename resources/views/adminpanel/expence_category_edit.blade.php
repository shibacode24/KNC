@extends('layout.header')
@section('content')
    <div class="page-content-wrap">
        <!-- <div class="page-content-wrap">
                             -->
        <div class="row">

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
        <div class="row">
            <div class="col-md-12" style="text-align: center;margin-top: 5px;">
                <h6 class="panel-title"
                    style="color:#FFFFFF; background-color:#d54e10; width:100%;height: 50%; font-size:16px;" align="center">
                    <i class="fa fa-file-text"><label style="margin: 7px;">Expense Master</label> </i>
                </h6>


            </div>
            <div class="col-md-6" style="margin-top: 2vh;">
                <h3 style="font-weight: bold;">Expense Category</h3>
                <form action="{{ route('update_expence_category') }}" method="post">
                    @csrf
                    <div class="col-md-12" style="margin-top: 2vh;">
                        <table width="50%">
                            <tr style="height:30px;">

                                <th width="5%">Add Expense Category</th>

                                <th width="1%"></th>
                            </tr>


                            <tr>
                                <input type="hidden" name="id" value="{{ $expence_categoryEdit->id }}">

                                <td style="padding: 2px;" width="1%">
                                    <input type="text" class="form-control" name="expence_category"
                                        value="{{ $expence_categoryEdit->expence_category }}" placeholder="" />
                                </td>

                                <td>
                                    <button id="on" type="submit" class="btn mjks"
                                        style="color:#FFFFFF; height:30px; width:auto;background-color: #006699;"><i
                                            class="fa fa-floppy-o" aria-hidden="true"></i>
                                        Update</button>
                                </td>
                            </tr>

                        </table>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
