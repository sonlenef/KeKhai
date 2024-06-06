@extends('layout')

@section('content')
<form id="form-id" action="{{ route('kekhai.store') }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @if(isset($hoso))
    <input type="hidden" name="id" value="{{ $hoso->id }}">
    @endif
    <div class="row">
        <div class="form-group col-sm-5">
            <label for="mst">MST:</label>
            <input type="text" class="form-control" id="mst" placeholder="Nhập MST" name="mst" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group  col-sm-7">
            <label for="name">Tên:</label>
            <input type="text" class="form-control" id="ten" placeholder="Nhập tên" name="ten" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-2">
            <label for="to">Tổ:</label>
            <input type="text" class="form-control" id="to" placeholder="Nhập tổ" name="to" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-3">
            <label for="ma_pnn">Mã PNN:</label>
            <input type="text" class="form-control" id="ma_pnn" placeholder="Nhập mã PNN" name="ma_pnn">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-2">
            <label for="so_gcn">Số GCN:</label>
            <input type="text" class="form-control" id="so_gcn" placeholder="Nhập số gcn" name="so_gcn" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-5">
            <label for="ngay_cap">Ngày cấp:</label>
            <input type="text" class="form-control" id="ngay_cap" placeholder="Nhập ngày cấp" name="ngay_cap" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-2">
            <label for="thua">Thửa:</label>
            <input type="text" class="form-control" id="tds" placeholder="Nhập thửa đất" name="tds" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-2">
            <label for="tbd">TBD:</label>
            <input type="text" class="form-control" id="tbd" placeholder="Nhập TBD" name="tbd" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-2">
            <label for="dt">DT:</label>
            <input type="text" class="form-control" id="dt" placeholder="Nhập DT" name="dt" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-6">
            <label for="duong_pho">Đường/phố:</label>
            <input type="text" class="form-control" id="duong_pho" placeholder="Nhập đường/phố" name="duong_pho"
                required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-4">
            <label for="doan_duong">Đoạn đường:</label>
            <input type="text" class="form-control" id="doan_duong" placeholder="Nhập đoạn đường" name="doan_duong"
                required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-8">
            <label for="dia_chi">Địa chỉ thửa đất:</label>
            <input type="text" class="form-control" id="dia_chi" placeholder="Nhập địa chỉ" name="dia_chi" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-1">
            <label for="han_muc">Hạn mức:</label>
            <input type="text" class="form-control" id="han_muc" placeholder="Nhập hạn mức" name="han_muc" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-1">
            <label for="vi_tri">Vị trí:</label>
            <input type="text" class="form-control" id="vi_tri" placeholder="Nhập vị trí" name="vi_tri" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-2">
            <label for="he_so_22">Hệ số 22-26:</label>
            <input type="number" class="form-control" id="he_so_22" placeholder="Nhập hệ số 22-26" name="he_so_22"
                required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-2">
            <label for="he_so_12">Hệ số 12-16:</label>
            <input type="number" class="form-control" id="he_so_12" placeholder="Nhập hệ số 12-16" name="he_so_12"
                required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-2">
            <label for="he_so_17">Hệ số 17-21:</label>
            <input type="number" class="form-control" id="he_so_17" placeholder="Nhập hệ số 17-21" name="he_so_17"
                required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-2">
            <label for="tu_ky">Từ kỳ:</label>
            <input type="text" class="form-control" id="tu_ky" placeholder="Nhập kỳ" name="tu_ky" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-2">
            <label for="den_ky">Đến kỳ:</label>
            <input type="text" class="form-control" id="den_ky" placeholder="Nhập kỳ" name="den_ky" value="31/12/2024"
                required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
    </div>
    <h6>Giá đất giai đoạn</h6>
    <dic class="row">
        <div class="form-group col-sm-4">
            <label for="gia_22">22-26</label>
            <input type="number" class="form-control" id="gia_22" placeholder="Nhập giá" name="gia_22" value="0"
                required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-4">
            <label for="tuky">17-21</label>
            <input type="text" class="form-control" id="gia_17" placeholder="Nhập giá" name="gia_17" value="0" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group col-sm-4">
            <label for="denky">12-16</label>
            <input type="text" class="form-control" id="gia_12" placeholder="Nhập giá" name="gia_12" value="0" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
    </dic>
    <div class="form-group">
        <label for="ghichu">Ghi chú</label>
        <textarea class="form-control" id="ghichu" placeholder="Nhập ghi chú" name="ghichu"></textarea>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <button id="form-submit-button" type="submit" class="btn btn-primary">Submit</button>
</form>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Oops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(isset($hoso))
<script>
$(document).ready(function() {
    // Fill in the form fields with the data from $hoso
    $("#mst").val('{{ $hoso->mst }}');
    $("#ten").val('{{ $hoso->ten }}');
    $("#to").val('{{ $hoso->to }}');
    $("#ma_pnn").val('{{ $hoso->ma_pnn }}');
    $("#so_gcn").val('{{ $hoso->so_gcn }}');
    $("#ngay_cap").val('{{ $hoso->ngay_cap }}');
    $("#tds").val('{{ $hoso->tds }}');
    $("#tbd").val('{{ $hoso->tbd }}');
    $("#dt").val('{{ $hoso->dt }}');
    $("#duong_pho").val('{{ $hoso->duong_pho }}');
    $("#doan_duong").val('{{ $hoso->doan_duong }}');
    $("#dia_chi").val('{{ $hoso->dia_chi }}');
    $("#han_muc").val('{{ $hoso->han_muc }}');
    $("#vi_tri").val('{{ $hoso->vi_tri }}');
    $("#he_so_22").val('{{ $hoso->he_so_22 }}');
    $("#he_so_12").val('{{ $hoso->he_so_12 }}');
    $("#he_so_17").val('{{ $hoso->he_so_17 }}');
    $("#tu_ky").val('{{ $hoso->tu_ky }}');
    $("#den_ky").val('{{ $hoso->den_ky }}');
    $("#gia_22").val('{{ $hoso->gia_22 }}');
    $("#gia_17").val('{{ $hoso->gia_17 }}');
    $("#gia_12").val('{{ $hoso->gia_12 }}');
    $("#ghichu").val('{{ $hoso->ghichu }}');
});
</script>
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
$(document).ready(function() {
    $('#form-submit-button').on('click', function(event) {
        var isValid = true;
        $('.needs-validation :input').each(function() {
            if ($(this).prop('required') && !$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
            }
        });
        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
            $('.needs-validation').addClass('was-validated');
        } else {
            event.preventDefault();
            var confirmation = confirm("Bạn có chắc chắn muốn gửi form không?");
            if (confirmation) {
                // Nếu người dùng đồng ý, submit form
                $('#form-id').submit();
            } else {
                // Nếu người dùng hủy, không làm gì cả
            }
        }
    });
});
</script>

<script>
$(document).ready(function() {
    var typingTimer;
    var doneTypingInterval = 200;

    $('#duong_pho, #doan_duong, #vi_tri, #ngay_cap').on('keyup', function() {
        clearTimeout(typingTimer);
        var $duong_pho = $('#duong_pho').val();
        var $doan_duong = $('#doan_duong').val();
        var $vi_tri = $('#vi_tri').val();

        typingTimer = setTimeout(function() {
            searchResults({
                duong: $duong_pho,
                doan: $doan_duong,
                vi_tri: $vi_tri
            });
        }, doneTypingInterval);
    });

    function searchResults(data) {
        $.ajax({
            type: 'GET',
            url: '/api/searchGiaDat',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.length > 0) {
                    var ngayCapValue = $('#ngay_cap').val();
                    var parts = ngayCapValue.split(
                        '/');

                    $('#gia_22').val(response[0].gia_dat);
                    $('#gia_17').val(response[1].gia_dat);
                    $('#gia_12').val(response[2].gia_dat);

                    if (parts.length == 3) {
                        var ngay = parseInt(parts[0], 10);
                        var thang = parseInt(parts[1], 10);
                        var nam = parseInt(parts[2], 10);

                        if (nam > 2019 || (nam === 2019 && (thang > 2 || (thang === 2 && ngay >
                                10)))) {
                            $('#gia_17').val(response[0].gia_dat);
                        } else {
                            $('#gia_17').val(response[1].gia_dat);
                        }
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
});
</script>

<script>
$(document).ready(function() {
    var availableOptions = <?php echo json_encode($duong_phos); ?>;

    $("#duong_pho").autocomplete({
        source: function(request, response) {
            var term = request.term.toLowerCase();
            var filteredOptions = availableOptions.filter(function(option) {
                return option.toLowerCase().indexOf(term) !== -1;
            });
            response(filteredOptions);
        }
    });
});
</script>
<script>
$(document).ready(function() {
    var availableOptions = <?php echo json_encode($doans); ?>;

    $("#doan_duong").autocomplete({
        source: function(request, response) {
            var term = request.term.toLowerCase();

            $.ajax({
                url: '/api/searchDoanDuong',
                method: 'GET',
                data: {
                    duong: $('#duong_pho').val()
                },
                dataType: 'json',
                success: function(data) {
                    availableOptions = $.map(data, function(item) {
                        return item.doan_duong;
                    });

                    var filteredOptions = availableOptions.filter(function(option) {
                        return option.toLowerCase().indexOf(term) !== -1;
                    });

                    response(filteredOptions);
                },
                error: function(xhr, status, error) {
                    availableOptions = <?php echo json_encode($doans); ?>;
                    var filteredOptions = availableOptions.filter(function(option) {
                        return option.toLowerCase().indexOf(term) !== -1;
                    });
                    response(filteredOptions);
                }
            });
        }
    });
});
</script>
<script>
$(document).ready(function() {
    var typingTimer;
    var doneTypingInterval = 200;

    $('#tds').on('keyup', function() {
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function() {
            $('#dia_chi').val('TĐS ' + $('#tds').val() + '-' + $('#tbd').val() + ', ' + $(
                '#duong_pho').val());
        }, doneTypingInterval);
    });

    $('#he_so_22').on('keyup', function() {
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function() {
            $('#he_so_12').val($('#he_so_22').val());
            $('#he_so_17').val($('#he_so_22').val());
        }, doneTypingInterval);
    });

    $('#tbd').on('keyup', function() {
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function() {
            $('#dia_chi').val('TĐS ' + $('#tds').val() + '-' + $('#tbd').val() + ', ' + $(
                '#duong_pho').val());
        }, doneTypingInterval);
    });

    $('#duong_pho').on('keyup', function() {
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function() {
            $('#dia_chi').val('TĐS ' + $('#tds').val() + '-' + $('#tbd').val() + ', ' + $(
                '#duong_pho').val());

            $.ajax({
                url: '/api/searchDoanDuong',
                method: 'GET',
                data: {
                    duong: $('#duong_pho').val()
                },
                dataType: 'json',
                success: function(data) {
                    if (data.length === 1) {
                        $('#doan_duong').val(data[0].doan_duong);
                    } else {
                        $('#doan_duong').val('');
                    }
                },
                error: function(xhr, status, error) {
                    $('#doan_duong').val('');
                }
            });
        }, doneTypingInterval);
    });

    $('#mst').on('keyup', function() {
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function() {
            inputCompleted($('#mst').val());
        }, doneTypingInterval);
    });

    function inputCompleted(value) {
        $.ajax({
            url: '/mst-request',
            method: 'GET',
            data: {
                q: value
            },
            success: function(response) {
                if (response.includes(value)) {
                    var name = response.split(' - ')[1];
                    if (name.length < 50) {
                        $('#ten').val(name);
                    }
                } else {
                    $('#ten').val('');
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.log('Error:', error);
            }
        });
    }
});
</script>
@endsection