@extends('layout.header')
@section('content')
    <div class="page-content-wrap">
        <!-- <div class="page-content-wrap">
                                 -->
        <div class="row">

            <div class="col-md-12" style="margin-top:5px;">
                <a href="{{route('expence-master')}}"> <button id="on" type="button" class="btn mjks"
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
                <h3 style="font-weight: bold;">Expense Head</h3>
                <form action="{{ route('update_expence_head') }}" method="post">
                    @csrf
                    <div class="col-md-12" style="margin-top: 2vh;">
                        <table width="100%">
                            <tr style="height:80px;">

                                <th width="40%">Select Expense Category</th>

                                <th width="40%" style="padding-left: 1vh;">Add Expense Head</th>

                            </tr>

                            <input type="hidden" value="{{ $expence_head_edit->id }}" name="id">
                            <tr>


                                <td style="padding: 2px;" width="25%">
                                    <select class="form-control select" data-live-search="true" name="expence_category_id">
                                        <option value="">Select</option>
                                        @foreach ($expence_categorys as $expence)
                                            <option value="{{ $expence->id }}"
                                                @if ($expence_head_edit->id == $expence->id) selected @endif>
                                                {{ $expence->expence_category }}</option>
                                        @endforeach

                                    </select>
                                </td>
                                <td style="padding: 2px;padding-left: 1vh;" width="25%">
                                    <input type="text" class="form-control" name="expence_head"
                                        {{ $expence_head_edit->expence_head }} placeholder="" />
                                </td>

                                <td>
                                    <button id="on" type="submit" class="btn mjks"
                                        style="color:#FFFFFF; height:30px; width:auto;background-color: #006699;"><i
                                            class="fa fa-floppy-o" aria-hidden="true"></i>
                                        Submit</button>
                                </td>
                            </tr>

                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
