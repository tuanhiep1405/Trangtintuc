<div class="mt-4 d-flex justify-content-between">
    <div>
        <input type="hidden" name="per-page" class="per-page" value="{{ $perPage }}">
        @if ($page == 1)
            Show
            <div class="btn-group mx-2">
                <button
                    class="btn btn-secondary btn-sm dropdown-toggle"
                    type="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    {{ $perPage }}
                </button>
                <div class="dropdown-menu">
                    <button
                        class="dropdown-item per-page-choose {{ $perPage == 5 ? 'disabled' : '' }}"
                        type="submit"
                        data-per-page="5"
                    >
                        5
                    </button>
                    <button
                        class="dropdown-item per-page-choose {{ $perPage == 10 ? 'disabled' : '' }}"
                        type="submit"
                        data-per-page="10"
                    >
                        10
                    </button>
                    <button
                        class="dropdown-item per-page-choose {{ $perPage == 15 ? 'disabled' : '' }}"
                        type="submit"
                        data-per-page="15"
                    >
                        15
                    </button>
                </div>
            </div>
            rows per page
        @endif
    </div>
    <nav>
        <ul class="pagination">
            <input type="hidden" name="page" class="page-page" value="{{ $page }}">
            @foreach (array_fill(1, $totalPage, NULL) as $index => $item)
                @if ($loop->first)
                    @if ($totalPage != 1)
                        <li class="page-item {{ $page == 1 ? 'disabled' : '' }}">
                            <button type="submit" class="page-link page-page-choose" data-page="{{ $page - 1 }}">
                                Previous
                            </button>
                        </li>
                    @endif
                @endif
                    @if ($totalPage != 1)
                        <li class="page-item {{ $page == $index ? 'active' : '' }}">
                            <button type="submit" class="page-link page-page-choose" data-page="{{ $index }}">
                                {{ $index }}
                            </button>
                        </li>
                    @endif
                @if ($loop->last)
                    @if ($totalPage != 1)
                        <li class="page-item {{ $page == $totalPage ? 'disabled' : '' }}">
                            <button type="submit" class="page-link page-page-choose" data-page="{{ $page + 1 }}">
                                Next
                            </button>
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
    </nav>
</div>

<script>

    let pageChooseElements = document.querySelectorAll('.page-page-choose');
    let perPageChooseElements = document.querySelectorAll('.per-page-choose');
    
    let btnSearch = document.querySelector('.btn-search');
    let btnFilter = document.querySelector('.btn-filter');

    let perPageInput = document.querySelector('.per-page');
    let pageInput = document.querySelector('.page-page');

    perPageChooseElements.forEach(element => {
        element.addEventListener('click', (e) => {
            perPageInput.value = e.target.dataset.perPage;
        })
    });

    pageChooseElements.forEach(element => {
        element.addEventListener('click', (e) => {
            pageInput.value = e.target.dataset.page;
        })
    });

    if(btnSearch) {
        btnSearch.addEventListener('click', (e) => {
            pageInput.value = 1
        })
    }

    if(btnFilter) {
        btnFilter.addEventListener('click', (e) => {
            pageInput.value = 1
        })
    }
    
</script>
