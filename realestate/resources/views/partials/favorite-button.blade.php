@php
    $isFavorite = DB::connection('mongodb')->table('favorite')
        ->where('username', session('user'))
        ->where('property_id', $property['_id'])
        ->exists();
@endphp

<!-- Inside the Blade file, replace the JavaScript part with the following form -->
<form action="{{ route('favorite.toggle') }}" method="POST">
    @csrf
    <input type="hidden" name="property_id" value="{{ $property['_id'] }}">
    <button type="submit" class="effect-round favorite-btn" style="color: {{ in_array($property['_id'], $favoritePropertyIds) ? 'red' : 'gray' }};">
        <i class="fa fa-heart"></i>
    </button>
</form>
