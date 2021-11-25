@extends('layout.app_seller')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">

        
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="card component-card_1">
                <div class="card-body">
                    <h5 class="card-title">Total Product</h5>
                    <div class="icon-svg">
                        <svg> ... </svg>
                    </div>
                    
                    <p class="card-text">Mauris nisi felis, placerat in volutpat id, varius et sapien.</p>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="card component-card_2">
                <div class="card-body">
                    <h5 class="card-title">Outstanding Invoice</h5>
                    <div class="icon-svg">
                        <svg> ... </svg>
                    </div>
                    
                    <p class="card-text">Mauris nisi felis, placerat in volutpat id, varius et sapien.</p>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="card component-card_3">
                <div class="card-body">
                    <h5 class="card-title">Incoming Order Item</h5>
                    <div class="icon-svg">
                        <svg> ... </svg>
                    </div>
                    
                    <p class="card-text">Mauris nisi felis, placerat in volutpat id, varius et sapien.</p>
                </div>
            </div>
        </div>
        {{-- outsid invoice --}}
    
        <div id="tableStriped" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                         <h4>Latest 10 Outgoing Order
                           
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-4" id="outgoing-order">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Id</th>
                                    <th>Tanggal</th>
                                    <th>Total Produk</th>
                                    
                                    <th class="text-center" width="35%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                               
                                
                            </tbody>
                        </table>
                    </div>  
                </div>
                {{-- tabel kedua --}}
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                         <h4>Latest 10 Activity Product
                           
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-4" id="activity-product">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>SKU</th>
                                    <th>Id</th>
                                    <th>Stok</th>
                                    
                                    <th class="text-center" width="35%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                               
                                
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
        </div>
        {{-- Batas Form Tabel --}}

      


    </div>
</div>


                        
                        
                        @endsection('content')