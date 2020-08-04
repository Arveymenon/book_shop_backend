@extends('layouts.default')

@section('content')

<div class="container">
    <div class="c-card">
        <form action='api/retailer-details/update' method='post'>
            {{ @csrf_field() }}

            <input class="c-input" id="retailer_user_id" type="hidden" name="retailer_user_id" value="0">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="c-field">
                            <label class="c-field__label" for="shop_name">Shop Name</label>
                            <input class="c-input" id="shop_name" type="text" required name="shop_name" placeholder="Placeholder">
                        </div>
                    </div>
                <div class="col-md-6 col-sm-12">
                    <div class="c-field">
                            <label class="c-field__label" for="address">Address</label>
                            <input class="c-input" id="address" type="text" name="address" placeholder="Placeholder">
                        </div>
                    </div>
                <div class="col-md-6 col-sm-12">
                    <div class="c-field">
                            <label class="c-field__label" for="longitude">Longitude</label>
                            <input class="c-input" id="longitude" type="text" name="longitude" placeholder="Placeholder">
                        </div>
                    </div>
                <div class="col-md-6 col-sm-12">
                    <div class="c-field">
                            <label class="c-field__label" for="latitude">Latitude</label>
                            <input class="c-input" id="latitude" type="text" name="latitude" placeholder="Placeholder">
                        </div>
                    </div>
                <div class="col-md-6 col-sm-12">
                    <div class="c-field">
                            <label class="c-field__label" for="path">Delivery Path</label>
                            <input class="c-input" id="path" type="text" required name="path" placeholder="Placeholder">
                        </div>
                    </div>
                <div class="col-md-6 col-sm-12">
                    <div class="c-field">
                            <label class="c-field__label" for="commission">Delivery Commission</label>
                            <input class="c-input" id="commission" type="text" required name="commission" placeholder="Placeholder">
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12">
                        <button class="c-btn c-btn--info c-btn--fullwidth">Update Profile</button>
                        </div>
                </div>
            </form>
    </div>

@endsection
