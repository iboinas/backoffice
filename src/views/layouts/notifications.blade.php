<div id="message_holder">

  @if (Session::has('error'))

    @foreach(Session::get('error') as $error)
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p>{{ $error }}</p>
      </div>
    @endforeach
  @endif

  @if (Session::has('errors'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      @foreach(Session::get('errors')->all() as $error)
        <p>{{ $error }}</p>
      @endforeach
    </div>
  @endif



  @if (Session::has('notice'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <p>{{ Session::get('notice') }}</p>
    </div>
  @endif

  @if (Session::has('notices'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      @foreach(Session::get('notice') as $notice)
        <p>{{ $notice }}</p>
      @endforeach
    </div>
  @endif



  @if (Session::has('message'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <p>{{ Session::get('message') }}</p>
    </div>
  @endif

  @if (Session::has('messages'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      @foreach(Session::get('messages')->all() as $error)
        <p>{{ $error }}</p>
      @endforeach
    </div>
  @endif
</div>