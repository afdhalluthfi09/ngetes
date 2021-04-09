<?php

namespace PHPMaker2021\umkm_sidakui;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // umkm_aspekdigimark
    $app->any('/umkmaspekdigimarklist[/{NIK}]', UmkmAspekdigimarkController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspekdigimarklist-umkm_aspekdigimark-list'); // list
    $app->any('/umkmaspekdigimarkadd[/{NIK}]', UmkmAspekdigimarkController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspekdigimarkadd-umkm_aspekdigimark-add'); // add
    $app->any('/umkmaspekdigimarkdelete[/{NIK}]', UmkmAspekdigimarkController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspekdigimarkdelete-umkm_aspekdigimark-delete'); // delete
    $app->group(
        '/umkm_aspekdigimark',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspekdigimarkController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspekdigimark/list-umkm_aspekdigimark-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspekdigimarkController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspekdigimark/add-umkm_aspekdigimark-add-2'); // add
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspekdigimarkController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspekdigimark/delete-umkm_aspekdigimark-delete-2'); // delete
        }
    );

    // umkm_aspekkeuangan
    $app->any('/umkmaspekkeuanganlist[/{NIK}]', UmkmAspekkeuanganController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspekkeuanganlist-umkm_aspekkeuangan-list'); // list
    $app->any('/umkmaspekkeuanganadd[/{NIK}]', UmkmAspekkeuanganController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspekkeuanganadd-umkm_aspekkeuangan-add'); // add
    $app->any('/umkmaspekkeuangandelete[/{NIK}]', UmkmAspekkeuanganController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspekkeuangandelete-umkm_aspekkeuangan-delete'); // delete
    $app->group(
        '/umkm_aspekkeuangan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspekkeuanganController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspekkeuangan/list-umkm_aspekkeuangan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspekkeuanganController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspekkeuangan/add-umkm_aspekkeuangan-add-2'); // add
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspekkeuanganController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspekkeuangan/delete-umkm_aspekkeuangan-delete-2'); // delete
        }
    );

    // umkm_aspeklembaga
    $app->any('/umkmaspeklembagalist[/{NIK}]', UmkmAspeklembagaController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspeklembagalist-umkm_aspeklembaga-list'); // list
    $app->any('/umkmaspeklembagaadd[/{NIK}]', UmkmAspeklembagaController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspeklembagaadd-umkm_aspeklembaga-add'); // add
    $app->any('/umkmaspeklembagadelete[/{NIK}]', UmkmAspeklembagaController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspeklembagadelete-umkm_aspeklembaga-delete'); // delete
    $app->group(
        '/umkm_aspeklembaga',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspeklembagaController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspeklembaga/list-umkm_aspeklembaga-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspeklembagaController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspeklembaga/add-umkm_aspeklembaga-add-2'); // add
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspeklembagaController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspeklembaga/delete-umkm_aspeklembaga-delete-2'); // delete
        }
    );

    // umkm_aspekpemasaran
    $app->any('/umkmaspekpemasaranlist[/{NIK}]', UmkmAspekpemasaranController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspekpemasaranlist-umkm_aspekpemasaran-list'); // list
    $app->any('/umkmaspekpemasaranadd[/{NIK}]', UmkmAspekpemasaranController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspekpemasaranadd-umkm_aspekpemasaran-add'); // add
    $app->any('/umkmaspekpemasarandelete[/{NIK}]', UmkmAspekpemasaranController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspekpemasarandelete-umkm_aspekpemasaran-delete'); // delete
    $app->group(
        '/umkm_aspekpemasaran',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspekpemasaranController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspekpemasaran/list-umkm_aspekpemasaran-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspekpemasaranController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspekpemasaran/add-umkm_aspekpemasaran-add-2'); // add
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspekpemasaranController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspekpemasaran/delete-umkm_aspekpemasaran-delete-2'); // delete
        }
    );

    // umkm_aspekproduksi
    $app->any('/umkmaspekproduksilist[/{NIK}]', UmkmAspekproduksiController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspekproduksilist-umkm_aspekproduksi-list'); // list
    $app->any('/umkmaspekproduksiadd[/{NIK}]', UmkmAspekproduksiController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspekproduksiadd-umkm_aspekproduksi-add'); // add
    $app->any('/umkmaspekproduksidelete[/{NIK}]', UmkmAspekproduksiController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspekproduksidelete-umkm_aspekproduksi-delete'); // delete
    $app->group(
        '/umkm_aspekproduksi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspekproduksiController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspekproduksi/list-umkm_aspekproduksi-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspekproduksiController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspekproduksi/add-umkm_aspekproduksi-add-2'); // add
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspekproduksiController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspekproduksi/delete-umkm_aspekproduksi-delete-2'); // delete
        }
    );

    // umkm_aspeksdm
    $app->any('/umkmaspeksdmlist[/{NIK}]', UmkmAspeksdmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspeksdmlist-umkm_aspeksdm-list'); // list
    $app->any('/umkmaspeksdmadd[/{NIK}]', UmkmAspeksdmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspeksdmadd-umkm_aspeksdm-add'); // add
    $app->any('/umkmaspeksdmdelete[/{NIK}]', UmkmAspeksdmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspeksdmdelete-umkm_aspeksdm-delete'); // delete
    $app->group(
        '/umkm_aspeksdm',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspeksdmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspeksdm/list-umkm_aspeksdm-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspeksdmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspeksdm/add-umkm_aspeksdm-add-2'); // add
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspeksdmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspeksdm/delete-umkm_aspeksdm-delete-2'); // delete
        }
    );

    // umkm_datadiri
    $app->any('/umkmdatadirilist[/{NIK}]', UmkmDatadiriController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmdatadirilist-umkm_datadiri-list'); // list
    $app->any('/umkmdatadiriedit[/{NIK}]', UmkmDatadiriController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkmdatadiriedit-umkm_datadiri-edit'); // edit
    $app->any('/umkmdatadiridelete[/{NIK}]', UmkmDatadiriController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmdatadiridelete-umkm_datadiri-delete'); // delete
    $app->group(
        '/umkm_datadiri',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmDatadiriController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_datadiri/list-umkm_datadiri-list-2'); // list
            $group->any('/' . Config("EDIT_ACTION") . '[/{NIK}]', UmkmDatadiriController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkm_datadiri/edit-umkm_datadiri-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmDatadiriController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_datadiri/delete-umkm_datadiri-delete-2'); // delete
        }
    );

    // umkm_datausaha
    $app->any('/umkmdatausahalist[/{NIK}]', UmkmDatausahaController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmdatausahalist-umkm_datausaha-list'); // list
    $app->any('/umkmdatausahaadd[/{NIK}]', UmkmDatausahaController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmdatausahaadd-umkm_datausaha-add'); // add
    $app->any('/umkmdatausahadelete[/{NIK}]', UmkmDatausahaController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmdatausahadelete-umkm_datausaha-delete'); // delete
    $app->group(
        '/umkm_datausaha',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmDatausahaController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_datausaha/list-umkm_datausaha-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmDatausahaController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_datausaha/add-umkm_datausaha-add-2'); // add
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmDatausahaController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_datausaha/delete-umkm_datausaha-delete-2'); // delete
        }
    );

    // umkm_variabel
    $app->any('/umkmvariabellist[/{id}]', UmkmVariabelController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmvariabellist-umkm_variabel-list'); // list
    $app->any('/umkmvariabeladd[/{id}]', UmkmVariabelController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmvariabeladd-umkm_variabel-add'); // add
    $app->any('/umkmvariabelview[/{id}]', UmkmVariabelController::class . ':view')->add(PermissionMiddleware::class)->setName('umkmvariabelview-umkm_variabel-view'); // view
    $app->any('/umkmvariabeledit[/{id}]', UmkmVariabelController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkmvariabeledit-umkm_variabel-edit'); // edit
    $app->any('/umkmvariabeldelete[/{id}]', UmkmVariabelController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmvariabeldelete-umkm_variabel-delete'); // delete
    $app->group(
        '/umkm_variabel',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', UmkmVariabelController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_variabel/list-umkm_variabel-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', UmkmVariabelController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_variabel/add-umkm_variabel-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', UmkmVariabelController::class . ':view')->add(PermissionMiddleware::class)->setName('umkm_variabel/view-umkm_variabel-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', UmkmVariabelController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkm_variabel/edit-umkm_variabel-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', UmkmVariabelController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_variabel/delete-umkm_variabel-delete-2'); // delete
        }
    );

    // indonesia_cities
    $app->any('/indonesiacitieslist[/{id}]', IndonesiaCitiesController::class . ':list')->add(PermissionMiddleware::class)->setName('indonesiacitieslist-indonesia_cities-list'); // list
    $app->any('/indonesiacitiesadd[/{id}]', IndonesiaCitiesController::class . ':add')->add(PermissionMiddleware::class)->setName('indonesiacitiesadd-indonesia_cities-add'); // add
    $app->any('/indonesiacitiesview[/{id}]', IndonesiaCitiesController::class . ':view')->add(PermissionMiddleware::class)->setName('indonesiacitiesview-indonesia_cities-view'); // view
    $app->any('/indonesiacitiesedit[/{id}]', IndonesiaCitiesController::class . ':edit')->add(PermissionMiddleware::class)->setName('indonesiacitiesedit-indonesia_cities-edit'); // edit
    $app->any('/indonesiacitiesdelete[/{id}]', IndonesiaCitiesController::class . ':delete')->add(PermissionMiddleware::class)->setName('indonesiacitiesdelete-indonesia_cities-delete'); // delete
    $app->group(
        '/indonesia_cities',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', IndonesiaCitiesController::class . ':list')->add(PermissionMiddleware::class)->setName('indonesia_cities/list-indonesia_cities-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', IndonesiaCitiesController::class . ':add')->add(PermissionMiddleware::class)->setName('indonesia_cities/add-indonesia_cities-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', IndonesiaCitiesController::class . ':view')->add(PermissionMiddleware::class)->setName('indonesia_cities/view-indonesia_cities-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', IndonesiaCitiesController::class . ':edit')->add(PermissionMiddleware::class)->setName('indonesia_cities/edit-indonesia_cities-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', IndonesiaCitiesController::class . ':delete')->add(PermissionMiddleware::class)->setName('indonesia_cities/delete-indonesia_cities-delete-2'); // delete
        }
    );

    // indonesia_districts
    $app->any('/indonesiadistrictslist[/{id}]', IndonesiaDistrictsController::class . ':list')->add(PermissionMiddleware::class)->setName('indonesiadistrictslist-indonesia_districts-list'); // list
    $app->any('/indonesiadistrictsadd[/{id}]', IndonesiaDistrictsController::class . ':add')->add(PermissionMiddleware::class)->setName('indonesiadistrictsadd-indonesia_districts-add'); // add
    $app->any('/indonesiadistrictsview[/{id}]', IndonesiaDistrictsController::class . ':view')->add(PermissionMiddleware::class)->setName('indonesiadistrictsview-indonesia_districts-view'); // view
    $app->any('/indonesiadistrictsedit[/{id}]', IndonesiaDistrictsController::class . ':edit')->add(PermissionMiddleware::class)->setName('indonesiadistrictsedit-indonesia_districts-edit'); // edit
    $app->any('/indonesiadistrictsdelete[/{id}]', IndonesiaDistrictsController::class . ':delete')->add(PermissionMiddleware::class)->setName('indonesiadistrictsdelete-indonesia_districts-delete'); // delete
    $app->group(
        '/indonesia_districts',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', IndonesiaDistrictsController::class . ':list')->add(PermissionMiddleware::class)->setName('indonesia_districts/list-indonesia_districts-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', IndonesiaDistrictsController::class . ':add')->add(PermissionMiddleware::class)->setName('indonesia_districts/add-indonesia_districts-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', IndonesiaDistrictsController::class . ':view')->add(PermissionMiddleware::class)->setName('indonesia_districts/view-indonesia_districts-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', IndonesiaDistrictsController::class . ':edit')->add(PermissionMiddleware::class)->setName('indonesia_districts/edit-indonesia_districts-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', IndonesiaDistrictsController::class . ':delete')->add(PermissionMiddleware::class)->setName('indonesia_districts/delete-indonesia_districts-delete-2'); // delete
        }
    );

    // indonesia_provinces
    $app->any('/indonesiaprovinceslist[/{id}]', IndonesiaProvincesController::class . ':list')->add(PermissionMiddleware::class)->setName('indonesiaprovinceslist-indonesia_provinces-list'); // list
    $app->any('/indonesiaprovincesadd[/{id}]', IndonesiaProvincesController::class . ':add')->add(PermissionMiddleware::class)->setName('indonesiaprovincesadd-indonesia_provinces-add'); // add
    $app->any('/indonesiaprovincesview[/{id}]', IndonesiaProvincesController::class . ':view')->add(PermissionMiddleware::class)->setName('indonesiaprovincesview-indonesia_provinces-view'); // view
    $app->any('/indonesiaprovincesedit[/{id}]', IndonesiaProvincesController::class . ':edit')->add(PermissionMiddleware::class)->setName('indonesiaprovincesedit-indonesia_provinces-edit'); // edit
    $app->any('/indonesiaprovincesdelete[/{id}]', IndonesiaProvincesController::class . ':delete')->add(PermissionMiddleware::class)->setName('indonesiaprovincesdelete-indonesia_provinces-delete'); // delete
    $app->group(
        '/indonesia_provinces',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', IndonesiaProvincesController::class . ':list')->add(PermissionMiddleware::class)->setName('indonesia_provinces/list-indonesia_provinces-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', IndonesiaProvincesController::class . ':add')->add(PermissionMiddleware::class)->setName('indonesia_provinces/add-indonesia_provinces-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', IndonesiaProvincesController::class . ':view')->add(PermissionMiddleware::class)->setName('indonesia_provinces/view-indonesia_provinces-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', IndonesiaProvincesController::class . ':edit')->add(PermissionMiddleware::class)->setName('indonesia_provinces/edit-indonesia_provinces-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', IndonesiaProvincesController::class . ':delete')->add(PermissionMiddleware::class)->setName('indonesia_provinces/delete-indonesia_provinces-delete-2'); // delete
        }
    );

    // indonesia_villages
    $app->any('/indonesiavillageslist[/{id}]', IndonesiaVillagesController::class . ':list')->add(PermissionMiddleware::class)->setName('indonesiavillageslist-indonesia_villages-list'); // list
    $app->any('/indonesiavillagesadd[/{id}]', IndonesiaVillagesController::class . ':add')->add(PermissionMiddleware::class)->setName('indonesiavillagesadd-indonesia_villages-add'); // add
    $app->any('/indonesiavillagesview[/{id}]', IndonesiaVillagesController::class . ':view')->add(PermissionMiddleware::class)->setName('indonesiavillagesview-indonesia_villages-view'); // view
    $app->any('/indonesiavillagesedit[/{id}]', IndonesiaVillagesController::class . ':edit')->add(PermissionMiddleware::class)->setName('indonesiavillagesedit-indonesia_villages-edit'); // edit
    $app->any('/indonesiavillagesdelete[/{id}]', IndonesiaVillagesController::class . ':delete')->add(PermissionMiddleware::class)->setName('indonesiavillagesdelete-indonesia_villages-delete'); // delete
    $app->group(
        '/indonesia_villages',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', IndonesiaVillagesController::class . ':list')->add(PermissionMiddleware::class)->setName('indonesia_villages/list-indonesia_villages-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', IndonesiaVillagesController::class . ':add')->add(PermissionMiddleware::class)->setName('indonesia_villages/add-indonesia_villages-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', IndonesiaVillagesController::class . ':view')->add(PermissionMiddleware::class)->setName('indonesia_villages/view-indonesia_villages-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', IndonesiaVillagesController::class . ':edit')->add(PermissionMiddleware::class)->setName('indonesia_villages/edit-indonesia_villages-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', IndonesiaVillagesController::class . ':delete')->add(PermissionMiddleware::class)->setName('indonesia_villages/delete-indonesia_villages-delete-2'); // delete
        }
    );

    // kumkm_literasi
    $app->any('/kumkmliterasilist[/{id}]', KumkmLiterasiController::class . ':list')->add(PermissionMiddleware::class)->setName('kumkmliterasilist-kumkm_literasi-list'); // list
    $app->any('/kumkmliterasiadd[/{id}]', KumkmLiterasiController::class . ':add')->add(PermissionMiddleware::class)->setName('kumkmliterasiadd-kumkm_literasi-add'); // add
    $app->any('/kumkmliterasiview[/{id}]', KumkmLiterasiController::class . ':view')->add(PermissionMiddleware::class)->setName('kumkmliterasiview-kumkm_literasi-view'); // view
    $app->any('/kumkmliterasiedit[/{id}]', KumkmLiterasiController::class . ':edit')->add(PermissionMiddleware::class)->setName('kumkmliterasiedit-kumkm_literasi-edit'); // edit
    $app->any('/kumkmliterasidelete[/{id}]', KumkmLiterasiController::class . ':delete')->add(PermissionMiddleware::class)->setName('kumkmliterasidelete-kumkm_literasi-delete'); // delete
    $app->group(
        '/kumkm_literasi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', KumkmLiterasiController::class . ':list')->add(PermissionMiddleware::class)->setName('kumkm_literasi/list-kumkm_literasi-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', KumkmLiterasiController::class . ':add')->add(PermissionMiddleware::class)->setName('kumkm_literasi/add-kumkm_literasi-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', KumkmLiterasiController::class . ':view')->add(PermissionMiddleware::class)->setName('kumkm_literasi/view-kumkm_literasi-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', KumkmLiterasiController::class . ':edit')->add(PermissionMiddleware::class)->setName('kumkm_literasi/edit-kumkm_literasi-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', KumkmLiterasiController::class . ':delete')->add(PermissionMiddleware::class)->setName('kumkm_literasi/delete-kumkm_literasi-delete-2'); // delete
        }
    );

    // v_umkm_datadiri
    $app->any('/vumkmdatadirilist[/{NIK}]', VUmkmDatadiriController::class . ':list')->add(PermissionMiddleware::class)->setName('vumkmdatadirilist-v_umkm_datadiri-list'); // list
    $app->any('/vumkmdatadiriedit[/{NIK}]', VUmkmDatadiriController::class . ':edit')->add(PermissionMiddleware::class)->setName('vumkmdatadiriedit-v_umkm_datadiri-edit'); // edit
    $app->group(
        '/v_umkm_datadiri',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', VUmkmDatadiriController::class . ':list')->add(PermissionMiddleware::class)->setName('v_umkm_datadiri/list-v_umkm_datadiri-list-2'); // list
            $group->any('/' . Config("EDIT_ACTION") . '[/{NIK}]', VUmkmDatadiriController::class . ':edit')->add(PermissionMiddleware::class)->setName('v_umkm_datadiri/edit-v_umkm_datadiri-edit-2'); // edit
        }
    );

    // panduanlist
    $app->any('/test/panduanlist[/{params:.*}]', PanduanlistController::class)->add(PermissionMiddleware::class)->setName('test/panduanlist-panduanlist-custom'); // custom

    // detail
    $app->any('/test/detail[/{params:.*}]', DetailController::class)->add(PermissionMiddleware::class)->setName('test/detail-detail-custom'); // custom

    // umkm_aspekdigimark_lm
    $app->any('/umkmaspekdigimarklmlist[/{NIK}]', UmkmAspekdigimarkLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspekdigimarklmlist-umkm_aspekdigimark_lm-list'); // list
    $app->any('/umkmaspekdigimarklmadd[/{NIK}]', UmkmAspekdigimarkLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspekdigimarklmadd-umkm_aspekdigimark_lm-add'); // add
    $app->any('/umkmaspekdigimarklmview[/{NIK}]', UmkmAspekdigimarkLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkmaspekdigimarklmview-umkm_aspekdigimark_lm-view'); // view
    $app->any('/umkmaspekdigimarklmedit[/{NIK}]', UmkmAspekdigimarkLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkmaspekdigimarklmedit-umkm_aspekdigimark_lm-edit'); // edit
    $app->any('/umkmaspekdigimarklmdelete[/{NIK}]', UmkmAspekdigimarkLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspekdigimarklmdelete-umkm_aspekdigimark_lm-delete'); // delete
    $app->group(
        '/umkm_aspekdigimark_lm',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspekdigimarkLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspekdigimark_lm/list-umkm_aspekdigimark_lm-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspekdigimarkLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspekdigimark_lm/add-umkm_aspekdigimark_lm-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NIK}]', UmkmAspekdigimarkLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkm_aspekdigimark_lm/view-umkm_aspekdigimark_lm-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NIK}]', UmkmAspekdigimarkLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkm_aspekdigimark_lm/edit-umkm_aspekdigimark_lm-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspekdigimarkLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspekdigimark_lm/delete-umkm_aspekdigimark_lm-delete-2'); // delete
        }
    );

    // umkm_aspekkeuangan_lm
    $app->any('/umkmaspekkeuanganlmlist[/{NIK}]', UmkmAspekkeuanganLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspekkeuanganlmlist-umkm_aspekkeuangan_lm-list'); // list
    $app->any('/umkmaspekkeuanganlmadd[/{NIK}]', UmkmAspekkeuanganLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspekkeuanganlmadd-umkm_aspekkeuangan_lm-add'); // add
    $app->any('/umkmaspekkeuanganlmview[/{NIK}]', UmkmAspekkeuanganLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkmaspekkeuanganlmview-umkm_aspekkeuangan_lm-view'); // view
    $app->any('/umkmaspekkeuanganlmedit[/{NIK}]', UmkmAspekkeuanganLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkmaspekkeuanganlmedit-umkm_aspekkeuangan_lm-edit'); // edit
    $app->any('/umkmaspekkeuanganlmdelete[/{NIK}]', UmkmAspekkeuanganLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspekkeuanganlmdelete-umkm_aspekkeuangan_lm-delete'); // delete
    $app->group(
        '/umkm_aspekkeuangan_lm',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspekkeuanganLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspekkeuangan_lm/list-umkm_aspekkeuangan_lm-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspekkeuanganLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspekkeuangan_lm/add-umkm_aspekkeuangan_lm-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NIK}]', UmkmAspekkeuanganLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkm_aspekkeuangan_lm/view-umkm_aspekkeuangan_lm-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NIK}]', UmkmAspekkeuanganLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkm_aspekkeuangan_lm/edit-umkm_aspekkeuangan_lm-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspekkeuanganLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspekkeuangan_lm/delete-umkm_aspekkeuangan_lm-delete-2'); // delete
        }
    );

    // umkm_aspeklembaga_lm
    $app->any('/umkmaspeklembagalmlist[/{NIK}]', UmkmAspeklembagaLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspeklembagalmlist-umkm_aspeklembaga_lm-list'); // list
    $app->any('/umkmaspeklembagalmadd[/{NIK}]', UmkmAspeklembagaLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspeklembagalmadd-umkm_aspeklembaga_lm-add'); // add
    $app->any('/umkmaspeklembagalmview[/{NIK}]', UmkmAspeklembagaLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkmaspeklembagalmview-umkm_aspeklembaga_lm-view'); // view
    $app->any('/umkmaspeklembagalmedit[/{NIK}]', UmkmAspeklembagaLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkmaspeklembagalmedit-umkm_aspeklembaga_lm-edit'); // edit
    $app->any('/umkmaspeklembagalmdelete[/{NIK}]', UmkmAspeklembagaLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspeklembagalmdelete-umkm_aspeklembaga_lm-delete'); // delete
    $app->group(
        '/umkm_aspeklembaga_lm',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspeklembagaLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspeklembaga_lm/list-umkm_aspeklembaga_lm-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspeklembagaLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspeklembaga_lm/add-umkm_aspeklembaga_lm-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NIK}]', UmkmAspeklembagaLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkm_aspeklembaga_lm/view-umkm_aspeklembaga_lm-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NIK}]', UmkmAspeklembagaLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkm_aspeklembaga_lm/edit-umkm_aspeklembaga_lm-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspeklembagaLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspeklembaga_lm/delete-umkm_aspeklembaga_lm-delete-2'); // delete
        }
    );

    // res_nilai_kelembagaan
    $app->any('/resnilaikelembagaanlist[/{nik}]', ResNilaiKelembagaanController::class . ':list')->add(PermissionMiddleware::class)->setName('resnilaikelembagaanlist-res_nilai_kelembagaan-list'); // list
    $app->group(
        '/res_nilai_kelembagaan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', ResNilaiKelembagaanController::class . ':list')->add(PermissionMiddleware::class)->setName('res_nilai_kelembagaan/list-res_nilai_kelembagaan-list-2'); // list
        }
    );

    // res_nilai_keuangan
    $app->any('/resnilaikeuanganlist[/{nik}]', ResNilaiKeuanganController::class . ':list')->add(PermissionMiddleware::class)->setName('resnilaikeuanganlist-res_nilai_keuangan-list'); // list
    $app->group(
        '/res_nilai_keuangan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', ResNilaiKeuanganController::class . ':list')->add(PermissionMiddleware::class)->setName('res_nilai_keuangan/list-res_nilai_keuangan-list-2'); // list
        }
    );

    // res_nilai_pemasaran
    $app->any('/resnilaipemasaranlist[/{nik}]', ResNilaiPemasaranController::class . ':list')->add(PermissionMiddleware::class)->setName('resnilaipemasaranlist-res_nilai_pemasaran-list'); // list
    $app->group(
        '/res_nilai_pemasaran',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', ResNilaiPemasaranController::class . ':list')->add(PermissionMiddleware::class)->setName('res_nilai_pemasaran/list-res_nilai_pemasaran-list-2'); // list
        }
    );

    // res_nilai_pemasaranonline
    $app->any('/resnilaipemasaranonlinelist[/{nik}]', ResNilaiPemasaranonlineController::class . ':list')->add(PermissionMiddleware::class)->setName('resnilaipemasaranonlinelist-res_nilai_pemasaranonline-list'); // list
    $app->group(
        '/res_nilai_pemasaranonline',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', ResNilaiPemasaranonlineController::class . ':list')->add(PermissionMiddleware::class)->setName('res_nilai_pemasaranonline/list-res_nilai_pemasaranonline-list-2'); // list
        }
    );

    // res_nilai_produksi
    $app->any('/resnilaiproduksilist[/{nik}]', ResNilaiProduksiController::class . ':list')->add(PermissionMiddleware::class)->setName('resnilaiproduksilist-res_nilai_produksi-list'); // list
    $app->group(
        '/res_nilai_produksi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', ResNilaiProduksiController::class . ':list')->add(PermissionMiddleware::class)->setName('res_nilai_produksi/list-res_nilai_produksi-list-2'); // list
        }
    );

    // res_nilai_sdm
    $app->any('/resnilaisdmlist[/{nik}]', ResNilaiSdmController::class . ':list')->add(PermissionMiddleware::class)->setName('resnilaisdmlist-res_nilai_sdm-list'); // list
    $app->group(
        '/res_nilai_sdm',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', ResNilaiSdmController::class . ':list')->add(PermissionMiddleware::class)->setName('res_nilai_sdm/list-res_nilai_sdm-list-2'); // list
        }
    );

    // temp_skor_kelas
    $app->any('/tempskorkelaslist[/{NIK}]', TempSkorKelasController::class . ':list')->add(PermissionMiddleware::class)->setName('tempskorkelaslist-temp_skor_kelas-list'); // list
    $app->any('/tempskorkelasadd[/{NIK}]', TempSkorKelasController::class . ':add')->add(PermissionMiddleware::class)->setName('tempskorkelasadd-temp_skor_kelas-add'); // add
    $app->any('/tempskorkelasview[/{NIK}]', TempSkorKelasController::class . ':view')->add(PermissionMiddleware::class)->setName('tempskorkelasview-temp_skor_kelas-view'); // view
    $app->any('/tempskorkelasedit[/{NIK}]', TempSkorKelasController::class . ':edit')->add(PermissionMiddleware::class)->setName('tempskorkelasedit-temp_skor_kelas-edit'); // edit
    $app->any('/tempskorkelasdelete[/{NIK}]', TempSkorKelasController::class . ':delete')->add(PermissionMiddleware::class)->setName('tempskorkelasdelete-temp_skor_kelas-delete'); // delete
    $app->group(
        '/temp_skor_kelas',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', TempSkorKelasController::class . ':list')->add(PermissionMiddleware::class)->setName('temp_skor_kelas/list-temp_skor_kelas-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', TempSkorKelasController::class . ':add')->add(PermissionMiddleware::class)->setName('temp_skor_kelas/add-temp_skor_kelas-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NIK}]', TempSkorKelasController::class . ':view')->add(PermissionMiddleware::class)->setName('temp_skor_kelas/view-temp_skor_kelas-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NIK}]', TempSkorKelasController::class . ':edit')->add(PermissionMiddleware::class)->setName('temp_skor_kelas/edit-temp_skor_kelas-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', TempSkorKelasController::class . ':delete')->add(PermissionMiddleware::class)->setName('temp_skor_kelas/delete-temp_skor_kelas-delete-2'); // delete
        }
    );

    // temp_skor_kelembagaan
    $app->any('/tempskorkelembagaanlist[/{nik}]', TempSkorKelembagaanController::class . ':list')->add(PermissionMiddleware::class)->setName('tempskorkelembagaanlist-temp_skor_kelembagaan-list'); // list
    $app->any('/tempskorkelembagaanadd[/{nik}]', TempSkorKelembagaanController::class . ':add')->add(PermissionMiddleware::class)->setName('tempskorkelembagaanadd-temp_skor_kelembagaan-add'); // add
    $app->any('/tempskorkelembagaanview[/{nik}]', TempSkorKelembagaanController::class . ':view')->add(PermissionMiddleware::class)->setName('tempskorkelembagaanview-temp_skor_kelembagaan-view'); // view
    $app->any('/tempskorkelembagaanedit[/{nik}]', TempSkorKelembagaanController::class . ':edit')->add(PermissionMiddleware::class)->setName('tempskorkelembagaanedit-temp_skor_kelembagaan-edit'); // edit
    $app->any('/tempskorkelembagaandelete[/{nik}]', TempSkorKelembagaanController::class . ':delete')->add(PermissionMiddleware::class)->setName('tempskorkelembagaandelete-temp_skor_kelembagaan-delete'); // delete
    $app->group(
        '/temp_skor_kelembagaan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', TempSkorKelembagaanController::class . ':list')->add(PermissionMiddleware::class)->setName('temp_skor_kelembagaan/list-temp_skor_kelembagaan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{nik}]', TempSkorKelembagaanController::class . ':add')->add(PermissionMiddleware::class)->setName('temp_skor_kelembagaan/add-temp_skor_kelembagaan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{nik}]', TempSkorKelembagaanController::class . ':view')->add(PermissionMiddleware::class)->setName('temp_skor_kelembagaan/view-temp_skor_kelembagaan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{nik}]', TempSkorKelembagaanController::class . ':edit')->add(PermissionMiddleware::class)->setName('temp_skor_kelembagaan/edit-temp_skor_kelembagaan-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{nik}]', TempSkorKelembagaanController::class . ':delete')->add(PermissionMiddleware::class)->setName('temp_skor_kelembagaan/delete-temp_skor_kelembagaan-delete-2'); // delete
        }
    );

    // temp_skor_keuangan
    $app->any('/tempskorkeuanganlist[/{nik}]', TempSkorKeuanganController::class . ':list')->add(PermissionMiddleware::class)->setName('tempskorkeuanganlist-temp_skor_keuangan-list'); // list
    $app->any('/tempskorkeuanganadd[/{nik}]', TempSkorKeuanganController::class . ':add')->add(PermissionMiddleware::class)->setName('tempskorkeuanganadd-temp_skor_keuangan-add'); // add
    $app->any('/tempskorkeuanganview[/{nik}]', TempSkorKeuanganController::class . ':view')->add(PermissionMiddleware::class)->setName('tempskorkeuanganview-temp_skor_keuangan-view'); // view
    $app->any('/tempskorkeuanganedit[/{nik}]', TempSkorKeuanganController::class . ':edit')->add(PermissionMiddleware::class)->setName('tempskorkeuanganedit-temp_skor_keuangan-edit'); // edit
    $app->any('/tempskorkeuangandelete[/{nik}]', TempSkorKeuanganController::class . ':delete')->add(PermissionMiddleware::class)->setName('tempskorkeuangandelete-temp_skor_keuangan-delete'); // delete
    $app->group(
        '/temp_skor_keuangan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', TempSkorKeuanganController::class . ':list')->add(PermissionMiddleware::class)->setName('temp_skor_keuangan/list-temp_skor_keuangan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{nik}]', TempSkorKeuanganController::class . ':add')->add(PermissionMiddleware::class)->setName('temp_skor_keuangan/add-temp_skor_keuangan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{nik}]', TempSkorKeuanganController::class . ':view')->add(PermissionMiddleware::class)->setName('temp_skor_keuangan/view-temp_skor_keuangan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{nik}]', TempSkorKeuanganController::class . ':edit')->add(PermissionMiddleware::class)->setName('temp_skor_keuangan/edit-temp_skor_keuangan-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{nik}]', TempSkorKeuanganController::class . ':delete')->add(PermissionMiddleware::class)->setName('temp_skor_keuangan/delete-temp_skor_keuangan-delete-2'); // delete
        }
    );

    // temp_skor_pemasaran
    $app->any('/tempskorpemasaranlist[/{nik}]', TempSkorPemasaranController::class . ':list')->add(PermissionMiddleware::class)->setName('tempskorpemasaranlist-temp_skor_pemasaran-list'); // list
    $app->any('/tempskorpemasaranadd[/{nik}]', TempSkorPemasaranController::class . ':add')->add(PermissionMiddleware::class)->setName('tempskorpemasaranadd-temp_skor_pemasaran-add'); // add
    $app->any('/tempskorpemasaranview[/{nik}]', TempSkorPemasaranController::class . ':view')->add(PermissionMiddleware::class)->setName('tempskorpemasaranview-temp_skor_pemasaran-view'); // view
    $app->any('/tempskorpemasaranedit[/{nik}]', TempSkorPemasaranController::class . ':edit')->add(PermissionMiddleware::class)->setName('tempskorpemasaranedit-temp_skor_pemasaran-edit'); // edit
    $app->any('/tempskorpemasarandelete[/{nik}]', TempSkorPemasaranController::class . ':delete')->add(PermissionMiddleware::class)->setName('tempskorpemasarandelete-temp_skor_pemasaran-delete'); // delete
    $app->group(
        '/temp_skor_pemasaran',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', TempSkorPemasaranController::class . ':list')->add(PermissionMiddleware::class)->setName('temp_skor_pemasaran/list-temp_skor_pemasaran-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{nik}]', TempSkorPemasaranController::class . ':add')->add(PermissionMiddleware::class)->setName('temp_skor_pemasaran/add-temp_skor_pemasaran-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{nik}]', TempSkorPemasaranController::class . ':view')->add(PermissionMiddleware::class)->setName('temp_skor_pemasaran/view-temp_skor_pemasaran-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{nik}]', TempSkorPemasaranController::class . ':edit')->add(PermissionMiddleware::class)->setName('temp_skor_pemasaran/edit-temp_skor_pemasaran-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{nik}]', TempSkorPemasaranController::class . ':delete')->add(PermissionMiddleware::class)->setName('temp_skor_pemasaran/delete-temp_skor_pemasaran-delete-2'); // delete
        }
    );

    // temp_skor_pemasaranonline
    $app->any('/tempskorpemasaranonlinelist[/{nik}]', TempSkorPemasaranonlineController::class . ':list')->add(PermissionMiddleware::class)->setName('tempskorpemasaranonlinelist-temp_skor_pemasaranonline-list'); // list
    $app->any('/tempskorpemasaranonlineadd[/{nik}]', TempSkorPemasaranonlineController::class . ':add')->add(PermissionMiddleware::class)->setName('tempskorpemasaranonlineadd-temp_skor_pemasaranonline-add'); // add
    $app->any('/tempskorpemasaranonlineview[/{nik}]', TempSkorPemasaranonlineController::class . ':view')->add(PermissionMiddleware::class)->setName('tempskorpemasaranonlineview-temp_skor_pemasaranonline-view'); // view
    $app->any('/tempskorpemasaranonlineedit[/{nik}]', TempSkorPemasaranonlineController::class . ':edit')->add(PermissionMiddleware::class)->setName('tempskorpemasaranonlineedit-temp_skor_pemasaranonline-edit'); // edit
    $app->any('/tempskorpemasaranonlinedelete[/{nik}]', TempSkorPemasaranonlineController::class . ':delete')->add(PermissionMiddleware::class)->setName('tempskorpemasaranonlinedelete-temp_skor_pemasaranonline-delete'); // delete
    $app->group(
        '/temp_skor_pemasaranonline',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', TempSkorPemasaranonlineController::class . ':list')->add(PermissionMiddleware::class)->setName('temp_skor_pemasaranonline/list-temp_skor_pemasaranonline-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{nik}]', TempSkorPemasaranonlineController::class . ':add')->add(PermissionMiddleware::class)->setName('temp_skor_pemasaranonline/add-temp_skor_pemasaranonline-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{nik}]', TempSkorPemasaranonlineController::class . ':view')->add(PermissionMiddleware::class)->setName('temp_skor_pemasaranonline/view-temp_skor_pemasaranonline-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{nik}]', TempSkorPemasaranonlineController::class . ':edit')->add(PermissionMiddleware::class)->setName('temp_skor_pemasaranonline/edit-temp_skor_pemasaranonline-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{nik}]', TempSkorPemasaranonlineController::class . ':delete')->add(PermissionMiddleware::class)->setName('temp_skor_pemasaranonline/delete-temp_skor_pemasaranonline-delete-2'); // delete
        }
    );

    // temp_skor_produksi
    $app->any('/tempskorproduksilist[/{nik}]', TempSkorProduksiController::class . ':list')->add(PermissionMiddleware::class)->setName('tempskorproduksilist-temp_skor_produksi-list'); // list
    $app->any('/tempskorproduksiadd[/{nik}]', TempSkorProduksiController::class . ':add')->add(PermissionMiddleware::class)->setName('tempskorproduksiadd-temp_skor_produksi-add'); // add
    $app->any('/tempskorproduksiview[/{nik}]', TempSkorProduksiController::class . ':view')->add(PermissionMiddleware::class)->setName('tempskorproduksiview-temp_skor_produksi-view'); // view
    $app->any('/tempskorproduksiedit[/{nik}]', TempSkorProduksiController::class . ':edit')->add(PermissionMiddleware::class)->setName('tempskorproduksiedit-temp_skor_produksi-edit'); // edit
    $app->any('/tempskorproduksidelete[/{nik}]', TempSkorProduksiController::class . ':delete')->add(PermissionMiddleware::class)->setName('tempskorproduksidelete-temp_skor_produksi-delete'); // delete
    $app->group(
        '/temp_skor_produksi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', TempSkorProduksiController::class . ':list')->add(PermissionMiddleware::class)->setName('temp_skor_produksi/list-temp_skor_produksi-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{nik}]', TempSkorProduksiController::class . ':add')->add(PermissionMiddleware::class)->setName('temp_skor_produksi/add-temp_skor_produksi-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{nik}]', TempSkorProduksiController::class . ':view')->add(PermissionMiddleware::class)->setName('temp_skor_produksi/view-temp_skor_produksi-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{nik}]', TempSkorProduksiController::class . ':edit')->add(PermissionMiddleware::class)->setName('temp_skor_produksi/edit-temp_skor_produksi-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{nik}]', TempSkorProduksiController::class . ':delete')->add(PermissionMiddleware::class)->setName('temp_skor_produksi/delete-temp_skor_produksi-delete-2'); // delete
        }
    );

    // temp_skor_sdm
    $app->any('/tempskorsdmlist[/{nik}]', TempSkorSdmController::class . ':list')->add(PermissionMiddleware::class)->setName('tempskorsdmlist-temp_skor_sdm-list'); // list
    $app->any('/tempskorsdmadd[/{nik}]', TempSkorSdmController::class . ':add')->add(PermissionMiddleware::class)->setName('tempskorsdmadd-temp_skor_sdm-add'); // add
    $app->any('/tempskorsdmview[/{nik}]', TempSkorSdmController::class . ':view')->add(PermissionMiddleware::class)->setName('tempskorsdmview-temp_skor_sdm-view'); // view
    $app->any('/tempskorsdmedit[/{nik}]', TempSkorSdmController::class . ':edit')->add(PermissionMiddleware::class)->setName('tempskorsdmedit-temp_skor_sdm-edit'); // edit
    $app->any('/tempskorsdmdelete[/{nik}]', TempSkorSdmController::class . ':delete')->add(PermissionMiddleware::class)->setName('tempskorsdmdelete-temp_skor_sdm-delete'); // delete
    $app->group(
        '/temp_skor_sdm',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}]', TempSkorSdmController::class . ':list')->add(PermissionMiddleware::class)->setName('temp_skor_sdm/list-temp_skor_sdm-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{nik}]', TempSkorSdmController::class . ':add')->add(PermissionMiddleware::class)->setName('temp_skor_sdm/add-temp_skor_sdm-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{nik}]', TempSkorSdmController::class . ':view')->add(PermissionMiddleware::class)->setName('temp_skor_sdm/view-temp_skor_sdm-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{nik}]', TempSkorSdmController::class . ':edit')->add(PermissionMiddleware::class)->setName('temp_skor_sdm/edit-temp_skor_sdm-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{nik}]', TempSkorSdmController::class . ':delete')->add(PermissionMiddleware::class)->setName('temp_skor_sdm/delete-temp_skor_sdm-delete-2'); // delete
        }
    );

    // temp_trans_skor
    $app->any('/temptransskorlist[/{nik}/{jenis_nilai}]', TempTransSkorController::class . ':list')->add(PermissionMiddleware::class)->setName('temptransskorlist-temp_trans_skor-list'); // list
    $app->any('/temptransskoradd[/{nik}/{jenis_nilai}]', TempTransSkorController::class . ':add')->add(PermissionMiddleware::class)->setName('temptransskoradd-temp_trans_skor-add'); // add
    $app->any('/temptransskorview[/{nik}/{jenis_nilai}]', TempTransSkorController::class . ':view')->add(PermissionMiddleware::class)->setName('temptransskorview-temp_trans_skor-view'); // view
    $app->any('/temptransskoredit[/{nik}/{jenis_nilai}]', TempTransSkorController::class . ':edit')->add(PermissionMiddleware::class)->setName('temptransskoredit-temp_trans_skor-edit'); // edit
    $app->any('/temptransskordelete[/{nik}/{jenis_nilai}]', TempTransSkorController::class . ':delete')->add(PermissionMiddleware::class)->setName('temptransskordelete-temp_trans_skor-delete'); // delete
    $app->group(
        '/temp_trans_skor',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{nik}/{jenis_nilai}]', TempTransSkorController::class . ':list')->add(PermissionMiddleware::class)->setName('temp_trans_skor/list-temp_trans_skor-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{nik}/{jenis_nilai}]', TempTransSkorController::class . ':add')->add(PermissionMiddleware::class)->setName('temp_trans_skor/add-temp_trans_skor-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{nik}/{jenis_nilai}]', TempTransSkorController::class . ':view')->add(PermissionMiddleware::class)->setName('temp_trans_skor/view-temp_trans_skor-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{nik}/{jenis_nilai}]', TempTransSkorController::class . ':edit')->add(PermissionMiddleware::class)->setName('temp_trans_skor/edit-temp_trans_skor-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{nik}/{jenis_nilai}]', TempTransSkorController::class . ':delete')->add(PermissionMiddleware::class)->setName('temp_trans_skor/delete-temp_trans_skor-delete-2'); // delete
        }
    );

    // umkm_aspekpemasaran_lm
    $app->any('/umkmaspekpemasaranlmlist[/{NIK}]', UmkmAspekpemasaranLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspekpemasaranlmlist-umkm_aspekpemasaran_lm-list'); // list
    $app->any('/umkmaspekpemasaranlmadd[/{NIK}]', UmkmAspekpemasaranLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspekpemasaranlmadd-umkm_aspekpemasaran_lm-add'); // add
    $app->any('/umkmaspekpemasaranlmview[/{NIK}]', UmkmAspekpemasaranLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkmaspekpemasaranlmview-umkm_aspekpemasaran_lm-view'); // view
    $app->any('/umkmaspekpemasaranlmedit[/{NIK}]', UmkmAspekpemasaranLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkmaspekpemasaranlmedit-umkm_aspekpemasaran_lm-edit'); // edit
    $app->any('/umkmaspekpemasaranlmdelete[/{NIK}]', UmkmAspekpemasaranLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspekpemasaranlmdelete-umkm_aspekpemasaran_lm-delete'); // delete
    $app->group(
        '/umkm_aspekpemasaran_lm',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspekpemasaranLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspekpemasaran_lm/list-umkm_aspekpemasaran_lm-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspekpemasaranLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspekpemasaran_lm/add-umkm_aspekpemasaran_lm-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NIK}]', UmkmAspekpemasaranLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkm_aspekpemasaran_lm/view-umkm_aspekpemasaran_lm-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NIK}]', UmkmAspekpemasaranLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkm_aspekpemasaran_lm/edit-umkm_aspekpemasaran_lm-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspekpemasaranLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspekpemasaran_lm/delete-umkm_aspekpemasaran_lm-delete-2'); // delete
        }
    );

    // umkm_aspekproduksi_lm
    $app->any('/umkmaspekproduksilmlist[/{NIK}]', UmkmAspekproduksiLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspekproduksilmlist-umkm_aspekproduksi_lm-list'); // list
    $app->any('/umkmaspekproduksilmadd[/{NIK}]', UmkmAspekproduksiLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspekproduksilmadd-umkm_aspekproduksi_lm-add'); // add
    $app->any('/umkmaspekproduksilmview[/{NIK}]', UmkmAspekproduksiLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkmaspekproduksilmview-umkm_aspekproduksi_lm-view'); // view
    $app->any('/umkmaspekproduksilmedit[/{NIK}]', UmkmAspekproduksiLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkmaspekproduksilmedit-umkm_aspekproduksi_lm-edit'); // edit
    $app->any('/umkmaspekproduksilmdelete[/{NIK}]', UmkmAspekproduksiLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspekproduksilmdelete-umkm_aspekproduksi_lm-delete'); // delete
    $app->group(
        '/umkm_aspekproduksi_lm',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspekproduksiLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspekproduksi_lm/list-umkm_aspekproduksi_lm-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspekproduksiLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspekproduksi_lm/add-umkm_aspekproduksi_lm-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NIK}]', UmkmAspekproduksiLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkm_aspekproduksi_lm/view-umkm_aspekproduksi_lm-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NIK}]', UmkmAspekproduksiLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkm_aspekproduksi_lm/edit-umkm_aspekproduksi_lm-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspekproduksiLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspekproduksi_lm/delete-umkm_aspekproduksi_lm-delete-2'); // delete
        }
    );

    // umkm_aspeksdm_lm
    $app->any('/umkmaspeksdmlmlist[/{NIK}]', UmkmAspeksdmLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkmaspeksdmlmlist-umkm_aspeksdm_lm-list'); // list
    $app->any('/umkmaspeksdmlmadd[/{NIK}]', UmkmAspeksdmLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkmaspeksdmlmadd-umkm_aspeksdm_lm-add'); // add
    $app->any('/umkmaspeksdmlmview[/{NIK}]', UmkmAspeksdmLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkmaspeksdmlmview-umkm_aspeksdm_lm-view'); // view
    $app->any('/umkmaspeksdmlmedit[/{NIK}]', UmkmAspeksdmLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkmaspeksdmlmedit-umkm_aspeksdm_lm-edit'); // edit
    $app->any('/umkmaspeksdmlmdelete[/{NIK}]', UmkmAspeksdmLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkmaspeksdmlmdelete-umkm_aspeksdm_lm-delete'); // delete
    $app->group(
        '/umkm_aspeksdm_lm',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{NIK}]', UmkmAspeksdmLmController::class . ':list')->add(PermissionMiddleware::class)->setName('umkm_aspeksdm_lm/list-umkm_aspeksdm_lm-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{NIK}]', UmkmAspeksdmLmController::class . ':add')->add(PermissionMiddleware::class)->setName('umkm_aspeksdm_lm/add-umkm_aspeksdm_lm-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{NIK}]', UmkmAspeksdmLmController::class . ':view')->add(PermissionMiddleware::class)->setName('umkm_aspeksdm_lm/view-umkm_aspeksdm_lm-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{NIK}]', UmkmAspeksdmLmController::class . ':edit')->add(PermissionMiddleware::class)->setName('umkm_aspeksdm_lm/edit-umkm_aspeksdm_lm-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{NIK}]', UmkmAspeksdmLmController::class . ':delete')->add(PermissionMiddleware::class)->setName('umkm_aspeksdm_lm/delete-umkm_aspeksdm_lm-delete-2'); // delete
        }
    );

    // v_skor_kelas
    $app->any('/vskorkelaslist', VSkorKelasController::class . ':list')->add(PermissionMiddleware::class)->setName('vskorkelaslist-v_skor_kelas-list'); // list
    $app->group(
        '/v_skor_kelas',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VSkorKelasController::class . ':list')->add(PermissionMiddleware::class)->setName('v_skor_kelas/list-v_skor_kelas-list-2'); // list
        }
    );

    // skro
    $app->any('/test/skro[/{params:.*}]', SkroController::class)->add(PermissionMiddleware::class)->setName('test/skro-skro-custom'); // custom

    // bina_data
    $app->any('/binadatalist[/{id}]', BinaDataController::class . ':list')->add(PermissionMiddleware::class)->setName('binadatalist-bina_data-list'); // list
    $app->any('/binadataadd[/{id}]', BinaDataController::class . ':add')->add(PermissionMiddleware::class)->setName('binadataadd-bina_data-add'); // add
    $app->any('/binadataview[/{id}]', BinaDataController::class . ':view')->add(PermissionMiddleware::class)->setName('binadataview-bina_data-view'); // view
    $app->any('/binadataedit[/{id}]', BinaDataController::class . ':edit')->add(PermissionMiddleware::class)->setName('binadataedit-bina_data-edit'); // edit
    $app->any('/binadatadelete[/{id}]', BinaDataController::class . ':delete')->add(PermissionMiddleware::class)->setName('binadatadelete-bina_data-delete'); // delete
    $app->group(
        '/bina_data',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BinaDataController::class . ':list')->add(PermissionMiddleware::class)->setName('bina_data/list-bina_data-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BinaDataController::class . ':add')->add(PermissionMiddleware::class)->setName('bina_data/add-bina_data-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BinaDataController::class . ':view')->add(PermissionMiddleware::class)->setName('bina_data/view-bina_data-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BinaDataController::class . ':edit')->add(PermissionMiddleware::class)->setName('bina_data/edit-bina_data-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BinaDataController::class . ':delete')->add(PermissionMiddleware::class)->setName('bina_data/delete-bina_data-delete-2'); // delete
        }
    );

    // bina_kelompok
    $app->any('/binakelompoklist[/{id}]', BinaKelompokController::class . ':list')->add(PermissionMiddleware::class)->setName('binakelompoklist-bina_kelompok-list'); // list
    $app->any('/binakelompokadd[/{id}]', BinaKelompokController::class . ':add')->add(PermissionMiddleware::class)->setName('binakelompokadd-bina_kelompok-add'); // add
    $app->any('/binakelompokview[/{id}]', BinaKelompokController::class . ':view')->add(PermissionMiddleware::class)->setName('binakelompokview-bina_kelompok-view'); // view
    $app->any('/binakelompokedit[/{id}]', BinaKelompokController::class . ':edit')->add(PermissionMiddleware::class)->setName('binakelompokedit-bina_kelompok-edit'); // edit
    $app->any('/binakelompokdelete[/{id}]', BinaKelompokController::class . ':delete')->add(PermissionMiddleware::class)->setName('binakelompokdelete-bina_kelompok-delete'); // delete
    $app->group(
        '/bina_kelompok',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BinaKelompokController::class . ':list')->add(PermissionMiddleware::class)->setName('bina_kelompok/list-bina_kelompok-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BinaKelompokController::class . ':add')->add(PermissionMiddleware::class)->setName('bina_kelompok/add-bina_kelompok-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BinaKelompokController::class . ':view')->add(PermissionMiddleware::class)->setName('bina_kelompok/view-bina_kelompok-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BinaKelompokController::class . ':edit')->add(PermissionMiddleware::class)->setName('bina_kelompok/edit-bina_kelompok-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BinaKelompokController::class . ':delete')->add(PermissionMiddleware::class)->setName('bina_kelompok/delete-bina_kelompok-delete-2'); // delete
        }
    );

    // bina_umkm_peserta
    $app->any('/binaumkmpesertalist[/{id}]', BinaUmkmPesertaController::class . ':list')->add(PermissionMiddleware::class)->setName('binaumkmpesertalist-bina_umkm_peserta-list'); // list
    $app->any('/binaumkmpesertaadd[/{id}]', BinaUmkmPesertaController::class . ':add')->add(PermissionMiddleware::class)->setName('binaumkmpesertaadd-bina_umkm_peserta-add'); // add
    $app->any('/binaumkmpesertaview[/{id}]', BinaUmkmPesertaController::class . ':view')->add(PermissionMiddleware::class)->setName('binaumkmpesertaview-bina_umkm_peserta-view'); // view
    $app->any('/binaumkmpesertaedit[/{id}]', BinaUmkmPesertaController::class . ':edit')->add(PermissionMiddleware::class)->setName('binaumkmpesertaedit-bina_umkm_peserta-edit'); // edit
    $app->any('/binaumkmpesertadelete[/{id}]', BinaUmkmPesertaController::class . ':delete')->add(PermissionMiddleware::class)->setName('binaumkmpesertadelete-bina_umkm_peserta-delete'); // delete
    $app->group(
        '/bina_umkm_peserta',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BinaUmkmPesertaController::class . ':list')->add(PermissionMiddleware::class)->setName('bina_umkm_peserta/list-bina_umkm_peserta-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BinaUmkmPesertaController::class . ':add')->add(PermissionMiddleware::class)->setName('bina_umkm_peserta/add-bina_umkm_peserta-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BinaUmkmPesertaController::class . ':view')->add(PermissionMiddleware::class)->setName('bina_umkm_peserta/view-bina_umkm_peserta-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BinaUmkmPesertaController::class . ':edit')->add(PermissionMiddleware::class)->setName('bina_umkm_peserta/edit-bina_umkm_peserta-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BinaUmkmPesertaController::class . ':delete')->add(PermissionMiddleware::class)->setName('bina_umkm_peserta/delete-bina_umkm_peserta-delete-2'); // delete
        }
    );

    // binadatalengkap
    $app->any('/binadatalengkaplist[/{id}]', BinadatalengkapController::class . ':list')->add(PermissionMiddleware::class)->setName('binadatalengkaplist-binadatalengkap-list'); // list
    $app->group(
        '/binadatalengkap',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BinadatalengkapController::class . ':list')->add(PermissionMiddleware::class)->setName('binadatalengkap/list-binadatalengkap-list-2'); // list
        }
    );

    // periode_data
    $app->any('/periodedatalist[/{id}]', PeriodeDataController::class . ':list')->add(PermissionMiddleware::class)->setName('periodedatalist-periode_data-list'); // list
    $app->any('/periodedataadd[/{id}]', PeriodeDataController::class . ':add')->add(PermissionMiddleware::class)->setName('periodedataadd-periode_data-add'); // add
    $app->any('/periodedataview[/{id}]', PeriodeDataController::class . ':view')->add(PermissionMiddleware::class)->setName('periodedataview-periode_data-view'); // view
    $app->any('/periodedataedit[/{id}]', PeriodeDataController::class . ':edit')->add(PermissionMiddleware::class)->setName('periodedataedit-periode_data-edit'); // edit
    $app->any('/periodedatadelete[/{id}]', PeriodeDataController::class . ':delete')->add(PermissionMiddleware::class)->setName('periodedatadelete-periode_data-delete'); // delete
    $app->group(
        '/periode_data',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', PeriodeDataController::class . ':list')->add(PermissionMiddleware::class)->setName('periode_data/list-periode_data-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', PeriodeDataController::class . ':add')->add(PermissionMiddleware::class)->setName('periode_data/add-periode_data-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', PeriodeDataController::class . ':view')->add(PermissionMiddleware::class)->setName('periode_data/view-periode_data-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', PeriodeDataController::class . ':edit')->add(PermissionMiddleware::class)->setName('periode_data/edit-periode_data-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', PeriodeDataController::class . ':delete')->add(PermissionMiddleware::class)->setName('periode_data/delete-periode_data-delete-2'); // delete
        }
    );

    // binapesertalengkap
    $app->any('/binapesertalengkaplist[/{id}]', BinapesertalengkapController::class . ':list')->add(PermissionMiddleware::class)->setName('binapesertalengkaplist-binapesertalengkap-list'); // list
    $app->group(
        '/binapesertalengkap',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BinapesertalengkapController::class . ':list')->add(PermissionMiddleware::class)->setName('binapesertalengkap/list-binapesertalengkap-list-2'); // list
        }
    );

    // userlevelpermissions
    $app->any('/userlevelpermissionslist[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissionslist-userlevelpermissions-list'); // list
    $app->any('/userlevelpermissionsadd[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissionsadd-userlevelpermissions-add'); // add
    $app->any('/userlevelpermissionsview[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissionsview-userlevelpermissions-view'); // view
    $app->any('/userlevelpermissionsedit[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissionsedit-userlevelpermissions-edit'); // edit
    $app->any('/userlevelpermissionsdelete[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissionsdelete-userlevelpermissions-delete'); // delete
    $app->group(
        '/userlevelpermissions',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissions/list-userlevelpermissions-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissions/add-userlevelpermissions-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissions/view-userlevelpermissions-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissions/edit-userlevelpermissions-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissions/delete-userlevelpermissions-delete-2'); // delete
        }
    );

    // userlevels
    $app->any('/userlevelslist[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelslist-userlevels-list'); // list
    $app->any('/userlevelsadd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelsadd-userlevels-add'); // add
    $app->any('/userlevelsview[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelsview-userlevels-view'); // view
    $app->any('/userlevelsedit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelsedit-userlevels-edit'); // edit
    $app->any('/userlevelsdelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelsdelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // _cetak_profilumkmlengkap2
    $app->any('/cetakprofilumkmlengkap2list', CetakProfilumkmlengkap2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('cetakprofilumkmlengkap2list-_cetak_profilumkmlengkap2-list'); // list
    $app->group(
        '/_cetak_profilumkmlengkap2',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', CetakProfilumkmlengkap2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('_cetak_profilumkmlengkap2/list-_cetak_profilumkmlengkap2-list-2'); // list
        }
    );

    // bina_umkm_peserta_copy
    $app->any('/binaumkmpesertacopylist[/{id}]', BinaUmkmPesertaCopyController::class . ':list')->add(PermissionMiddleware::class)->setName('binaumkmpesertacopylist-bina_umkm_peserta_copy-list'); // list
    $app->any('/binaumkmpesertacopyadd[/{id}]', BinaUmkmPesertaCopyController::class . ':add')->add(PermissionMiddleware::class)->setName('binaumkmpesertacopyadd-bina_umkm_peserta_copy-add'); // add
    $app->any('/binaumkmpesertacopyview[/{id}]', BinaUmkmPesertaCopyController::class . ':view')->add(PermissionMiddleware::class)->setName('binaumkmpesertacopyview-bina_umkm_peserta_copy-view'); // view
    $app->any('/binaumkmpesertacopyedit[/{id}]', BinaUmkmPesertaCopyController::class . ':edit')->add(PermissionMiddleware::class)->setName('binaumkmpesertacopyedit-bina_umkm_peserta_copy-edit'); // edit
    $app->any('/binaumkmpesertacopydelete[/{id}]', BinaUmkmPesertaCopyController::class . ':delete')->add(PermissionMiddleware::class)->setName('binaumkmpesertacopydelete-bina_umkm_peserta_copy-delete'); // delete
    $app->group(
        '/bina_umkm_peserta_copy',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BinaUmkmPesertaCopyController::class . ':list')->add(PermissionMiddleware::class)->setName('bina_umkm_peserta_copy/list-bina_umkm_peserta_copy-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BinaUmkmPesertaCopyController::class . ':add')->add(PermissionMiddleware::class)->setName('bina_umkm_peserta_copy/add-bina_umkm_peserta_copy-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BinaUmkmPesertaCopyController::class . ':view')->add(PermissionMiddleware::class)->setName('bina_umkm_peserta_copy/view-bina_umkm_peserta_copy-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BinaUmkmPesertaCopyController::class . ':edit')->add(PermissionMiddleware::class)->setName('bina_umkm_peserta_copy/edit-bina_umkm_peserta_copy-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BinaUmkmPesertaCopyController::class . ':delete')->add(PermissionMiddleware::class)->setName('bina_umkm_peserta_copy/delete-bina_umkm_peserta_copy-delete-2'); // delete
        }
    );

    // cetak_profilumkmlengkap
    $app->any('/cetakprofilumkmlengkaplist', CetakProfilumkmlengkapController::class . ':list')->add(PermissionMiddleware::class)->setName('cetakprofilumkmlengkaplist-cetak_profilumkmlengkap-list'); // list
    $app->group(
        '/cetak_profilumkmlengkap',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', CetakProfilumkmlengkapController::class . ':list')->add(PermissionMiddleware::class)->setName('cetak_profilumkmlengkap/list-cetak_profilumkmlengkap-list-2'); // list
        }
    );

    // kumkm_market
    $app->any('/kumkmmarketlist[/{id}]', KumkmMarketController::class . ':list')->add(PermissionMiddleware::class)->setName('kumkmmarketlist-kumkm_market-list'); // list
    $app->any('/kumkmmarketadd[/{id}]', KumkmMarketController::class . ':add')->add(PermissionMiddleware::class)->setName('kumkmmarketadd-kumkm_market-add'); // add
    $app->any('/kumkmmarketview[/{id}]', KumkmMarketController::class . ':view')->add(PermissionMiddleware::class)->setName('kumkmmarketview-kumkm_market-view'); // view
    $app->any('/kumkmmarketedit[/{id}]', KumkmMarketController::class . ':edit')->add(PermissionMiddleware::class)->setName('kumkmmarketedit-kumkm_market-edit'); // edit
    $app->any('/kumkmmarketdelete[/{id}]', KumkmMarketController::class . ':delete')->add(PermissionMiddleware::class)->setName('kumkmmarketdelete-kumkm_market-delete'); // delete
    $app->group(
        '/kumkm_market',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', KumkmMarketController::class . ':list')->add(PermissionMiddleware::class)->setName('kumkm_market/list-kumkm_market-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', KumkmMarketController::class . ':add')->add(PermissionMiddleware::class)->setName('kumkm_market/add-kumkm_market-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', KumkmMarketController::class . ':view')->add(PermissionMiddleware::class)->setName('kumkm_market/view-kumkm_market-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', KumkmMarketController::class . ':edit')->add(PermissionMiddleware::class)->setName('kumkm_market/edit-kumkm_market-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', KumkmMarketController::class . ':delete')->add(PermissionMiddleware::class)->setName('kumkm_market/delete-kumkm_market-delete-2'); // delete
        }
    );

    // php_kurasi_lolos
    $app->any('/phpkurasiloloslist[/{id}]', PhpKurasiLolosController::class . ':list')->add(PermissionMiddleware::class)->setName('phpkurasiloloslist-php_kurasi_lolos-list'); // list
    $app->group(
        '/php_kurasi_lolos',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', PhpKurasiLolosController::class . ':list')->add(PermissionMiddleware::class)->setName('php_kurasi_lolos/list-php_kurasi_lolos-list-2'); // list
        }
    );

    // php_kurasi_perbaikan
    $app->any('/phpkurasiperbaikanlist[/{id}]', PhpKurasiPerbaikanController::class . ':list')->add(PermissionMiddleware::class)->setName('phpkurasiperbaikanlist-php_kurasi_perbaikan-list'); // list
    $app->any('/phpkurasiperbaikanedit[/{id}]', PhpKurasiPerbaikanController::class . ':edit')->add(PermissionMiddleware::class)->setName('phpkurasiperbaikanedit-php_kurasi_perbaikan-edit'); // edit
    $app->group(
        '/php_kurasi_perbaikan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', PhpKurasiPerbaikanController::class . ':list')->add(PermissionMiddleware::class)->setName('php_kurasi_perbaikan/list-php_kurasi_perbaikan-list-2'); // list
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', PhpKurasiPerbaikanController::class . ':edit')->add(PermissionMiddleware::class)->setName('php_kurasi_perbaikan/edit-php_kurasi_perbaikan-edit-2'); // edit
        }
    );

    // Produk_Lolos_Kurasi
    $app->any('/produkloloskurasilist', ProdukLolosKurasiController::class . ':list')->add(PermissionMiddleware::class)->setName('produkloloskurasilist-Produk_Lolos_Kurasi-list'); // list
    $app->any('/produkloloskurasiadd', ProdukLolosKurasiController::class . ':add')->add(PermissionMiddleware::class)->setName('produkloloskurasiadd-Produk_Lolos_Kurasi-add'); // add
    $app->group(
        '/produk_lolos_kurasi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', ProdukLolosKurasiController::class . ':list')->add(PermissionMiddleware::class)->setName('produk_lolos_kurasi/list-Produk_Lolos_Kurasi-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '', ProdukLolosKurasiController::class . ':add')->add(PermissionMiddleware::class)->setName('produk_lolos_kurasi/add-Produk_Lolos_Kurasi-add-2'); // add
        }
    );

    // Produk_Tidak_Lolos_Kurasi
    $app->any('/produktidakloloskurasilist', ProdukTidakLolosKurasiController::class . ':list')->add(PermissionMiddleware::class)->setName('produktidakloloskurasilist-Produk_Tidak_Lolos_Kurasi-list'); // list
    $app->any('/produktidakloloskurasiadd', ProdukTidakLolosKurasiController::class . ':add')->add(PermissionMiddleware::class)->setName('produktidakloloskurasiadd-Produk_Tidak_Lolos_Kurasi-add'); // add
    $app->group(
        '/produk_tidak_lolos_kurasi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', ProdukTidakLolosKurasiController::class . ':list')->add(PermissionMiddleware::class)->setName('produk_tidak_lolos_kurasi/list-Produk_Tidak_Lolos_Kurasi-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '', ProdukTidakLolosKurasiController::class . ':add')->add(PermissionMiddleware::class)->setName('produk_tidak_lolos_kurasi/add-Produk_Tidak_Lolos_Kurasi-add-2'); // add
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->any('/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->any('/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // reset_password
    $app->any('/resetpassword', OthersController::class . ':resetpassword')->add(PermissionMiddleware::class)->setName('resetpassword');

    // change_password
    $app->any('/changepassword', OthersController::class . ':changepassword')->add(PermissionMiddleware::class)->setName('changepassword');

    // register
    $app->any('/register', OthersController::class . ':register')->add(PermissionMiddleware::class)->setName('register');

    // logout
    $app->any('/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // barcode
    $app->any('/barcode', OthersController::class . ':barcode')->add(PermissionMiddleware::class)->setName('barcode');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
