<form action="{{route('searchSupplierAds.user')}}" method="post">
    @csrf
    <select name="cat" id="cat">
        <option value="">دنبال چی میگردی؟</option>

        <option value="{{$id}}"> {{$title}} </option>
    </select>
    <input type="input" name='search' value="{{$search}}" class="header-input large my-2" placeholder="آدرس، منطقه، محله">
    <button class="RecBtn red">جستجو</button>
</form>
