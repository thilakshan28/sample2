<!-------<div>
    <x-label for="title" :value="__('Title')" />

    <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
</div>
<div>
    <x-label for="content" :value="__('Content')" />

    <x-input id="content" class="block mt-1 w-full" type="textarea"  name="content" :value="old('content')" required autofocus />
</div>-->
{!! Form::text('title', 'Title') !!}

{!! Form::text('content', 'Content') !!}
<!--
<div class="form-group">
    <label for="province">Province:</label>
 <select id="province" name="province" class="form-control">
      <option value="" selected disabled>Select Province</option>
       foreach($provinces as $province)
       <option value="$province->id}}"> $province->name}}</option>
       endforeach
       </select>
  </div>--->
  {!!Form::file('file', 'Document')!!}
<!---<div class="form-group">
    <label for="district">District:</label>
    <select name="district" id="district" class="form-control"></select>
  </div>--->


  @section('js')
  <script>
    $('#province').change(function(){
    var province = $(this).val();
    if(province){
      $.ajax({
        type:"GET",
        url:"{{ route('get.district')}}?province="+province,
        success:function(res){
        if(res){
          $("#district").empty();
          $("#district").append('<option>Select District</option>');
          $.each(res,function(key,value){
          $("#district").append('<option value="'+value.id+'">'+value.name+'</option>');})
        } else {
          $("#district").empty();
        }
        }
      });
    }else{
      $("#district").empty();
    }
    });

  </script>
@endsection
