@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4" id="table-details"></div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <button class="btn btn-primary btn-block" id="btn-show-tables">View All Tables</button>
            <div id="selected_table"></div>
            <div id="order_menu"></div>
        </div>
        <div class="col-md-7">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach($categories as $category)
                    <a class="nav-item nav-link" data-id="{{$category->id}}" data-toggle="tab">
                        {{$category->name}}
                    </a>
                    @endforeach
                </div>
            </nav>
            <div id="list-menu" class="row mt-2"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //hide all tables by default.
        $('#table-details').hide();

        //show all tables when botton is clicked
        $("#btn-show-tables").click(function() {

            if ($('#table-details').is(":hidden")) {
                //send get request to the controller to get all tables from the database.
                $.get("/cashier/getTable", function(data) {
                    $("#table-details").html(data);
                    $("#table-details").slideDown("fast");
                    $('#btn-show-tables').html('Hide All Table').removeClass('btn-primary').addClass('btn-danger');
                })
            }
            $("#table-details").slideUp("fast");
            $('#btn-show-tables').html('View All Table').removeClass('btn-danger').addClass('btn-primary');

        });
    });

    //load Menus By Category
    $(".nav-link").click(function() {

        $.get("/cashier/getMenuByCategory/" + $(this).data("id"), function(data) {
            $("#list-menu").hide();
            $("#list-menu").html(data);
            $("#list-menu").fadeIn();
        });
    })
    var SELECTED_TABLE_ID = "";
    var SELECTED_TABLE_NAME = "";
    //detect button table onclick to show table data
    $("#table-details").on("click", ".btn-table", function() {

        SELECTED_TABLE_ID = $(this).data("id");
        SELECTED_TABLE_NAME = $(this).data("name");

        $("#selected_table").html('<br><h3>Table: ' + SELECTED_TABLE_NAME + '</h3><hr>');

    });

    $("#list-menu").on("click", ".menu", function() {
        if (SELECTED_TABLE_ID == "") {
            alert("Please select a table to add menu")
        } else {
            var menu_id = $(this).data("id");
            $.ajax({
                type: "POST",
                data: {
                    "_token": $('meta[name = "csrf-token"]').attr('content'),
                    "menu_id": menu_id,
                    "table_id": SELECTED_TABLE_ID,
                    "table_name": SELECTED_TABLE_NAME,
                    "quantity": 1

                },
                url: "/cashier/orderFood",
                success: function(data) {
                    $("#order_menu").html(data)
                }

            });
        }

    });
</script>

@endsection