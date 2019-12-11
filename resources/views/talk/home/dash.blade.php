@extends('layout.layout')
@section('title') Dash @endsection

@section('hrow') @endsection

@section('body')
<div class="row match-height">
    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="p-2 text-xs-center bg-deep-orange media-left media-middle">
                        <i class="icon-user1 font-large-2 white"></i>
                    </div>
                    <div class="p-2 media-body">
                        <h5 class="deep-orange">New Users</h5>
                        <h5 class="text-bold-400">1,22,356</h5>
                        <progress class="progress progress-sm progress-deep-orange mt-1 mb-0" value="45" max="100"></progress>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="p-2 text-xs-center bg-cyan media-left media-middle">
                        <i class="icon-camera7 font-large-2 white"></i>
                    </div>
                    <div class="p-2 media-body">
                        <h5>New Products</h5>
                        <h5 class="text-bold-400">28</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="p-2 media-body text-xs-left">
                        <h5>New Users</h5>
                        <h5 class="text-bold-400">1,22,356</h5>
                    </div>
                    <div class="p-2 text-xs-center bg-teal media-right media-middle">
                        <i class="icon-user1 font-large-2 white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Recent Invoices</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="card-block">
                    <p>Total paid invoices 240, unpaid 150. <span class="float-xs-right"><a href="#">Invoice Summary <i class="icon-arrow-right2"></i></a></span></p>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Invoice#</th>
                            <th>Customer Name</th>
                            <th>Status</th>
                            <th>Due</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-truncate"><a href="#">INV-001001</a></td>
                            <td class="text-truncate">Elizabeth W.</td>
                            <td class="text-truncate"><span class="tag tag-default tag-success">Paid</span></td>
                            <td class="text-truncate">10/05/2016</td>
                            <td class="text-truncate">$ 1200.00</td>
                        </tr>
                        <tr>
                            <td class="text-truncate"><a href="#">INV-001012</a></td>
                            <td class="text-truncate">Andrew D.</td>
                            <td class="text-truncate"><span class="tag tag-default tag-success">Paid</span></td>
                            <td class="text-truncate">20/07/2016</td>
                            <td class="text-truncate">$ 152.00</td>
                        </tr>
                        <tr>
                            <td class="text-truncate"><a href="#">INV-001401</a></td>
                            <td class="text-truncate">Megan S.</td>
                            <td class="text-truncate"><span class="tag tag-default tag-success">Paid</span></td>
                            <td class="text-truncate">16/11/2016</td>
                            <td class="text-truncate">$ 1450.00</td>
                        </tr>
                        <tr>
                            <td class="text-truncate"><a href="#">INV-01112</a></td>
                            <td class="text-truncate">Doris R.</td>
                            <td class="text-truncate"><span class="tag tag-default tag-warning">Overdue</span></td>
                            <td class="text-truncate">11/12/2016</td>
                            <td class="text-truncate">$ 5685.00</td>
                        </tr>
                        <tr>
                            <td class="text-truncate"><a href="#">INV-008101</a></td>
                            <td class="text-truncate">Walter R.</td>
                            <td class="text-truncate"><span class="tag tag-default tag-warning">Overdue</span></td>
                            <td class="text-truncate">18/05/2016</td>
                            <td class="text-truncate">$ 685.00</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection