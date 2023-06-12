<!-- search section -->
<div class="container-fluid search-fluid">
    <div class="container">
        <div class="search-wrapper">

            <ul class="nav nav-tabs search-nav-tabs" id="myTab" role="tablist">
                <li class="nav-item search-nav-item">
                    <a class="nav-link snav-link active"
                       id="home-tab" data-toggle="tab"
                       href="../#home" role="tab">Tìm việc làm</a>
                </li>
            </ul>
            <div class="tab-content search-tab-content" id="myTabContent">
                <!-- content tab 1 -->
                <div class="tab-pane stab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form class="bn-search-form" action="{{ route('jobs.search') }}">
                        <div class="row">
                            <div class="col-md-10 col-sm-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="input-group s-input-group">
                                            <input type="text" name="title" class="form-control sinput"
                                                   value="{{ old('title', request()->input('title')) }}"
                                                   placeholder="Nhập kỹ năng, công việc,...">
                                            <span><i class="fa fa-search"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="computer-languages" name="language">
                                            <option value="" selected hidden>Tất cả ngôn ngữ</option>
                                            @foreach($languagesComposer as $key => $language)
                                                <option {{ request()->input('language') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $language }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fa fa-code sfa" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="s-provinces" name="location">
                                            <option value="" selected hidden>Tất cả địa điểm</option>
                                            @foreach($citiesComposer as $city)
                                                <option {{ request()->input('location') == $city->id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fa fa-map-marker sfa" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <button type="submit" class="btn btn-primary btn-search col-sm-12">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- (end) search section -->
