@include('manager/mainMenu')
<x-table type="default" :headers="['عنوان','شناسه کاربری','تاریخ ایجاد','تاریخ آخرین تغییر']" :body="$posts"/>
@include('manager/footer')
