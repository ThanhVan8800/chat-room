<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header">
                        Chat Room
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="nam" id="name" style = "margin-bottom: 40px;">
                        </div>
                        <div class="form-group" id="data-message" style="padding:100px;">

                        </div>


                        <div class="form-group">
                            <textarea  id="message" class="form-control" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-primary">Send</button>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>
    <script src="{{url('js/app.js')}}"></script>

    <script>
        $(function(){
            const Http = window.axios;
            const Echo = window.Echo;
            const name = $('#name');
            const message = $('#message');
            $("input, textarea").keyup(function() {
                $(this).removeClass('is-invalid');
            });
            $('button').click(function() {
                let has_errors = false;
                if(name.val() == ''){
                    alert('Nhập tên của bạn');
                    has_errors = true;
                }
                if(message.val() == ''){
                    alert('Nhập nội dung bạn muốn gửi');
                    has_errors = true;
                } else{
                    Http.post("{{url('/send')}}",{
                        'name' : name.val(),
                        'message' : message.val(),
                    }).then(()=>{
                        message.val('');
                    })
                }
            });
            let channel = Echo.channel('channel-chat');
            channel.listen('ChatEvent', function(data){
                $('#data-message')
                    .append(`<strong>${data.message.name}</strong>: ${data.message.message}<br>`);
            });
        })
    </script>

</body>
</html>