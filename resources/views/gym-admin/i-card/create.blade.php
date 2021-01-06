<div class="row">
    @foreach($clients as $client)

        <div class="col-xs-12 col-md-3 col-print-4">
            <div class="i-card-container">
                <div class="row">
                    <div class="col-xs-12 text-center qr-code-container">
                        <?php
                            // Generate encrypted check in url
                            $encryptedParameter = rand(1111111,9999999).$client->id.'-'.rand(1111,9999).str_random(19);
                            $encryptedParameter = \Illuminate\Support\Facades\Crypt::encrypt($encryptedParameter);
                            $url = route('gym-qr-check-in', [$encryptedParameter]);
                        ?>

                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate($url) !!}
                    </div>
                    <div class="col-xs-12 i-card-contact">
                        <strong style="font-size: 15px">{{ ucwords($common_details->title) }}</strong>

                        <p class="i-card-user-detail">
                            <i class="fa fa-user"></i> {{ ucwords($client->first_name.' '.$client->last_name) }} <br>
                            <em>(Member)</em><br>
                            <i class="fa fa-phone"></i> {{ $client->mobile }} <br>
                            <i class="fa fa-envelope-o"></i> {{ $client->email }} <br>
                        </p>
                    </div>

                </div>
            </div>
        </div>

    @endforeach

</div>
