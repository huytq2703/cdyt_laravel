<table>
    <thead>
    <tr>
        <th style="width: 30px; background-color: #2a8b6c">Id</th>
        <th style="width: 120px; background-color: #2a8b6c">Họ và tên</th>
        <th style="width: 150px; background-color: #2a8b6c">Email</th>
        <th style="width: 100px; background-color: #2a8b6c">Số điện thoại</th>
        <th style="width: 100px; background-color: #2a8b6c">Ngày sinh</th>
        <th style="width: 70px; background-color: #2a8b6c">Giới tính</th>
        <th style="width: 60px; background-color: #2a8b6c">Tôn giáo</th>
        <th style="width: 70px; background-color: #2a8b6c">Dân tộc</th>
        <th style="width: 70px; background-color: #2a8b6c">Học vấn</th>
        <th style="width: 140px; background-color: #2a8b6c">Đối tượng ưu tiên</th>
        <th style="width: 100px; background-color: #2a8b6c">Ngành đăng ký</th>
        <th style="width: 100px; background-color: #2a8b6c">Địa chỉ</th>
        <th style="width: 100px; background-color: #2a8b6c">Tỉnh/TP</th>
        <th style="width: 100px; background-color: #2a8b6c">Quận/Huyện</th>
        <th style="width: 100px; background-color: #2a8b6c">Xã/Phường</th>
        <th style="width: 100px; background-color: #2a8b6c">Trạng thái</th>
        <th style="width: 200px; background-color: #2a8b6c">Ghi chú</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $i)
        <tr>
            <td>{{ $i->id }}</td>
            <td>{{ $i->full_name }}</td>
            <td>{{ $i->email }}</td>
            <td>{{ $i->phone_number }}</td>
            <td>{{ $i->birthday }}</td>
            <td>{{ $i->gender === 1 ? "Nam" : "Nữ" }}</td>
            <td>{{ $i->religion }}</td>
            <td>{{ $i->nation }}</td>
            <td>{{ $i->level }}</td>
            <td>{{ $i->priority_object }}</td>
            <td>{{ $i->majors?->name }}</td>
            <td>{{ $i->address }}</td>
            <td>{{ $i?->province?->name }}</td>
            <td>{{ $i?->district?->name }}</td>
            <td>{{ $i?->ward?->name }}</td>
            <td>{{ $i?->status === 1 ? "Đã xử lý" : "Chưa xử lý" }}</td>
            <td>{{ $i?->notes}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
