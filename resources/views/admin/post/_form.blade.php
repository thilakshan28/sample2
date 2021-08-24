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

