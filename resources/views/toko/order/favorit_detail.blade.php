@extends('toko.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-5">
            <hr>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                {{ $fastMoveDetail->nama_fast_move_detail }}
            </div>
            <div class="card-body">
                <div class="row">
                    <?php $arr = []; ?>
                    @foreach ($fastMoveDetail->skema as $skema)
                        <div class="col-12">
                            {{ $skema->nama_skema }}
                        </div>
                        <div class="col-12">
                            @foreach ($skema->skema_detail as $item)
                                <label class="btn btn-outline-secondary rounded">
                                    <input type="radio" name="{{ $skema->nama_skema }}" value="{{ $item->detail }}">
                                    {{ $item->detail }}
                                </label>
                            @endforeach
                        </div>
                        <?php array_push($arr, $skema->nama_skema); ?>
                    @endforeach
                    <?php $js_arr = json_encode($arr); ?>
                    <div class="col-12">
                        <input type="hidden" value="{{ $fastMoveDetail->nama_fast_move_detail }}" id="produk">
                        <input type="hidden" value="{{ $fastMove->id }}" id="fast_move_id">
                        <input type="hidden" value="{{ $fastMove->brand_id }}" id="brand_id">
                        <div class="row" id="bodyFavorit">

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-2">
                                <span class="btn" id="minus">-</span>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="qty_produk" value="1" />
                            </div>
                            <div class="col-2">
                                <span class="btn" id="plus">+</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <br>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success form-control" onclick="order()">Troli</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var skema = JSON.parse('{!! $js_arr !!}');
            $.each(skema, function(key, value) {
                $('#bodyFavorit').append('<div class="col-sm-6">' +
                    '<div class="form-group">' +
                    '<label>' +
                    value +
                    '</label>' +
                    '<input class="form-control" id="' + value + '" readonly>' +
                    '</div>' +
                    '</div>')
                $('input[type=radio][name=' + value + ']').change(function() {
                    $('#' + value).val(this.value)
                })
            })

            $('#minus').click(function() {
                var $input = $('#qty_produk');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('#plus').click(function() {
                var $input = $('#qty_produk');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        })

        function order() {
            var skema = JSON.parse('{!! $js_arr !!}');
            var produk = $('#produk').val();
            var final_produk = produk;
            var qty_produk = $('#qty_produk').val();
            var brand_id = $('#brand_id').val();
            var fast_move_id = $('#fast_move_id').val();
            try {
                $.each(skema, function(key, value) {
                    var y = $('#' + value).val()
                    if (y == '') throw "Pilih Detail anda";
                    if (qty_produk < 1)  throw "QTY tidak boleh kurang dari 1"
                    final_produk = final_produk + ' ' + y;
                })

                Swal.fire({
                    icon: 'info',
                    title: 'Masukan Ke troli?',
                    html: final_produk,
                    footer: 'Save Untuk menyimpan ke Troli',
                    showCloseButton: true,
                    showConfirmButton: true,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: '/order/troli/favorit',
                            data: {
                                _token: "{{ csrf_token() }}",
                                brand_id: brand_id,
                                fast_move_id: fast_move_id,
                                produk: final_produk,
                                qty: qty_produk,
                            },
                            success: function () {
                                Swal.fire('Masuk Ke troli!', '', 'success');
                                window.location.reload();
                            },
                            error: function () {
                                Swal.fire('Gagal Menyimpan', '', 'danger')
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Perubahan tidak disimpan', '', 'info')
                    }
                })
            } catch (error) {
                Swal.fire({
                    icon: 'warning',
                    title: error    ,
                    // footer: '<a href="">Why do I have this issue?</a>',
                    showCloseButton: true,
                    showConfirmButton: false
                });
            }


        }
    </script>
@endsection
