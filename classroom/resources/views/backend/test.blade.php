<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>


</head>
<body>
    <form id="change_name">
        @csrf
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <button type="submit" class="btn btn-success">ยืนยัน</button>
    </form>


    {{-- <form action="{{route('pairing.edit')}}" method="post" enctype="multipart/form-data">
        @csrf
        Namesss: <input type="text" name="name"><br>
        E-mailsss: <input type="text" name="email"><br>
        <button type="submit" class="btn btn-success">ยืนยัน</button>
    </form> --}}

<script src="{{ asset('js/app.js') }}"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        var name ="anut";
        var password = "chai";
        var email = "bsod";


        $('form#change_name').submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);
            console.log('6666');
            $.ajax({
                url:"{{ route('pairing.edit') }}",
                method: "POST",
                //data:formData,
                // data: {token: 5},

                // data: {
                //         "FirstName": 'm',
                //         "LastName": 'l',
                //     },

                data:{name:name, password:password, email:email},
                dataType: "JSON",

                success: function(data){
                    alert('ss');
                },
                error: function(data){
                    alert('bb');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });






</script>

</body>
</html>












