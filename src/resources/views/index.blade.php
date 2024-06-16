@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="text-center">Danh Sách Tờ Khai</h2>
    </div>
    <br>
    <div class="col-sm-12 row justify-content-center align-items-center">
        <form class="col-sm-12 text-center" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h6>Cập nhật danh sách tờ khai: </h6>
            <a href="{{ asset('example.xlsx') }}" class="btn btn-link" download>Tải file mẫu</a>
            <input type="file" name="file" />
            <button class="btn btn-primary" type="submit">Upload</button>
        </form>
    </div>
    <div class="col-sm-12 row justify-content-center align-items-center">
        <form class="col-sm-12 text-center" action="{{ route('uploadExcel') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <h6>Cập nhật mã PNN từ sổ bộ: </h6>
            <input type="file" name="file" />
            <button class="btn btn-primary" type="submit">Upload Sổ Bộ</button>
        </form>
    </div>
    <br>
    <div class="col-sm-12 row justify-content-center align-items-center">
        <div class="col-sm-3 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('kekhai.create') }}">Thêm tờ khai</a>
        </div>
        <div class="col-sm-3 text-center"><a class="btn btn-success" href="{{ route('export') }}">Tải xuống</a></div>
        <!-- Dùng một cột trống để tạo khoảng cách giữa hai nút -->
        <form class="col-sm-3 text-center" id="resetForm" action="{{ route('reset') }}" method="DELETE">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Làm mới</button>
        </form>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    {{ $message }}
</div>
@endif

@if(sizeof($hosos) > 0)
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="white-space: nowrap;">STT</th>
                <th style="white-space: nowrap;">NST</th>
                <th style="white-space: nowrap;">Mã PNN</th>
                <th style="white-space: nowrap;">Tên</th>
                <th style="white-space: nowrap;">Tổ</th>
                <th style="white-space: nowrap;">Số GCN</th>
                <th style="white-space: nowrap;">Ngày cấp</th>
                <th style="white-space: nowrap;">TDS</th>
                <th style="white-space: nowrap;">TBD</th>
                <th style="white-space: nowrap;">Diện tích</th>
                <th style="white-space: nowrap;">Đường/phố</th>
                <th style="white-space: nowrap;">Đoạn đường</th>
                <th style="white-space: nowrap;">Địa chỉ thửa đất</th>
                <th style="white-space: nowrap;">Hạn mức</th>
                <th style="white-space: nowrap;">Vị trí</th>
                <th style="white-space: nowrap;">Hệ số 22-26</th>
                <th style="white-space: nowrap;">Hệ số 12-16</th>
                <th style="white-space: nowrap;">Hệ số 17-21</th>
                <th style="white-space: nowrap;">Từ kỳ</th>
                <th style="white-space: nowrap;">Đến kỳ</th>
                <th style="white-space: nowrap;">Giá đất 22-26CN</th>
                <th style="white-space: nowrap;">Giá đất 17-21CN</th>
                <th style="white-space: nowrap;">Giá đất 12-16CN</th>
                <th width="280px">More</th>
            </tr>
        </thead>
        @foreach ($hosos as $hoso)
        @php
        // Lấy năm từ tu_ky để so sánh
        $year = \Carbon\Carbon::createFromFormat('m/Y', $hoso->tu_ky)->year;
        @endphp
        <tr @if($year < 2017 && $hoso->gia_12 == 0) style="background-color: #ffcccc;"
            @endif>
            <td>{{ ++$i }}</td>
            <td><span @if(strlen($hoso->mst) != 10) style="color: red;" @endif>{{ $hoso->mst }}</span></td>
            <td><span @if(strlen($hoso->ma_pnn) == '') style="background-color: red;" @endif>{{ $hoso->ma_pnn }}</span>
            </td>
            <td style="white-space: nowrap;">{{ $hoso->ten }}</td>
            <td>{{ $hoso->to }}</td>
            <td style="white-space: nowrap;">{{ $hoso->so_gcn }}</td>
            <td style="white-space: nowrap;">{{ $hoso->ngay_cap }}</td>
            <td>{{ $hoso->tds }}</td>
            <td>{{ $hoso->tbd }}</td>
            <td>{{ $hoso->dt }}</td>
            <td style="white-space: nowrap;">{{ $hoso->duong_pho }}</td>
            <td style="white-space: nowrap;">{{ $hoso->doan_duong }}</td>
            <td style="white-space: nowrap;">{{ $hoso->dia_chi }}</td>
            <td>{{ $hoso->han_muc }}</td>
            <td>{{ $hoso->vi_tri }}</td>
            <td>{{ $hoso->he_so_22 }}</td>
            <td>{{ $hoso->he_so_12 }}</td>
            <td>{{ $hoso->he_so_17 }}</td>
            <td>{{ $hoso->tu_ky }}</td>
            <td>{{ $hoso->den_ky }}</td>
            <td>{{ $hoso->gia_22 }}</td>
            <td>{{ $hoso->gia_17 }}</td>
            <td>{{ $hoso->gia_12 }}</td>
            <td style="white-space: nowrap;">
                <form action="{{ route('kekhai.destroy', $hoso->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('kekhai.edit', $hoso->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@else
<div class="alert alert-alert">Start Adding to the Database.</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('resetForm').addEventListener('submit', function(event) {
        event.preventDefault();

        if (confirm("Bạn có chắc muốn làm mới không?")) {
            // Gửi yêu cầu DELETE khi người dùng xác nhận
            fetch(this.action, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.ok) {
                    // Reload trang sau khi thành công
                    window.location.reload();
                } else {
                    // Xử lý lỗi nếu cần
                }
            }).catch(error => {
                // Xử lý lỗi nếu cần
            });
        }
    });
});
</script>
@endsection