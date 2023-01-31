@if(session()->has('message'))
    <div id="message"class="alert alert-success">
     {{ session()->get('message') }}
    </div>
@endif

<script type="text/javascript">
    window.setTimeout("document.getElementById('message').style.display='none';", 2000);
    </script>
