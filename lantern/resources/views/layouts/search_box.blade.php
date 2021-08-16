{{-- 検索窓 --}}
<div class="search">
    <form class="search-form" method="GET" action="{{ route('search.index')}}">
        <span class="fas fa-search"></span>
        <input class="input-form" type="search" name="keyword" placeholder="食材名・料理名・調理時間 など" />
    </form>
</div>