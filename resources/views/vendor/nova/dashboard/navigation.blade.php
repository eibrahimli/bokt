<router-link exact tag="h3"
             :to="{
        name: 'dashboard.custom',
        params: {
            name: 'main'
        }
    }"
             class="cursor-pointer flex items-center font-normal dim text-white mb-8 text-base no-underline">
    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
         viewBox="0 0 20 20">
        <defs>
            <path id="b"
                  d="M11 18v-5H9v5c0 1.1045695-.8954305 2-2 2H4c-1.1045695 0-2-.8954305-2-2v-7.5857864l-.29289322.2928932c-.39052429.3905243-1.02368927.3905243-1.41421356 0-.3905243-.3905243-.3905243-1.02368929 0-1.41421358l9-9C9.48815536.09763107 9.74407768 0 10 0c.2559223 0 .5118446.09763107.7071068.29289322l9 9c.3905243.39052429.3905243 1.02368928 0 1.41421358-.3905243.3905243-1.0236893.3905243-1.4142136 0L18 10.4142136V18c0 1.1045695-.8954305 2-2 2h-3c-1.1045695 0-2-.8954305-2-2zm5 0V8.41421356l-6-6-6 6V18h3v-5c0-1.1045695.8954305-2 2-2h2c1.1045695 0 2 .8954305 2 2v5h3z"/>
            <filter id="a" width="135%" height="135%" x="-17.5%" y="-12.5%" filterUnits="objectBoundingBox">
                <feOffset dy="1" in="SourceAlpha" result="shadowOffsetOuter1"/>
                <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="1"/>
                <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.166610054 0"/>
            </filter>
        </defs>
        <g fill="none" fill-rule="evenodd">
            <use fill="#000" filter="url(#a)" xlink:href="#b"/>
            <use fill="var(--sidebar-icon)" xlink:href="#b"/>
        </g>
    </svg>
    <span class="text-white sidebar-label">{{ __('Dashboard') }}</span>
</router-link>

<div class="list-reset mb-8">
    <div class="leading-wide mb-4">
        {{--        <div class="text-white no-underline">--}}
        {{--            Menu--}}
        {{--        </div>--}}
        <ul class="list-reset mb-8">
            @foreach ($documentGroups as $group)
                <li class="leading-wide mb-4 ml-8 text-sm">
                    <div class="my-2">
                        <router-link
                            :to='{
                name: "index",
                params: {
                resourceName: "{{ $group::uriKey() }}"
                }
                }'
                            exact
                            class="text-white no-underline dim"
                        >{{$group::label()}}</router-link>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="list-reset mb-8">
    <div class="leading-wide mb-4">
        <div class="text-white ml-1 no-underline">
            Hesabatlar
        </div>
        <ul class="list-reset mb-8">
            <div class="py-2">
                <li class="leading-wide mb-4 ml-8 text-sm">
                    <a href="{{ url('/resources/reports') }}" class="text-white text-justify no-underline dim">
                        Maliyyə vəziyyəti haqqında hesabat (Balans)
                    </a>
                </li>
                <li class="leading-wide mb-4 ml-8 text-sm">
                    <a href="{{ url('/resources/reports') }}" class="text-white text-justify no-underline dim">
                        Gəlir və xərclər haqqında hesabat
                    </a>
                </li>
                <li class="leading-wide mb-4 ml-8 text-sm">
                    <a href="{{ url('/resources/reports') }}" class="text-white text-justify no-underline dim">
                        Pul vəsaitlərin hərəkəri haqqında hesabat
                    </a>
                </li>
                <li class="leading-wide mb-4 ml-8 text-sm">
                    <a href="{{ url('/resources/reports') }}" class="text-white text-justify no-underline dim">
                        Kapitalda dəyişikliklər haqqında hesabat
                    </a>
                </li>
                <li class="leading-wide mb-4 ml-8 text-sm">
                    <a href="{{ url('/resources/reports') }}" class="text-white text-justify no-underline dim">
                        Mərkəzi banka təqdim edilən hesabat
                    </a>
                </li>
            </div>

        </ul>
    </div>
</div>

<div class="list-reset mb-8">
    <div class="leading-wide mb-4">
        <div class="text-white ml-1 no-underline">
            Mühasibatlıq
        </div>
        <ul class="list-reset mb-8">
            {{--<div class="py-2">
                <li class="leading-wide mb-4 ml-8 text-sm">
                    <a href="#" class="text-white text-justify no-underline dim">
                        Təchizatçılar
                    </a>
                </li>
                <li class="leading-wide mb-4 ml-8 text-sm">
                    <a href="#" class="text-white text-justify no-underline dim">
                        Əməliyyatlar (Dt/Kr)
                    </a>
                </li>
                <li class="leading-wide mb-4 ml-8 text-sm">
                    <a href="#" class="text-white text-justify no-underline dim">
                        İş və xidmətlər
                    </a>
                </li>
                <li class="leading-wide mb-4 ml-8 text-sm">
                    <a href="#" class="text-white text-justify no-underline dim">
                        Əsas vəsaitlər və QMA
                    </a>
                </li>
                <li class="leading-wide mb-4 ml-8 text-sm">
                    <a href="#" class="text-white text-justify no-underline dim">
                        Bank əməliyyatları
                    </a>
                </li>
            </div>--}}

        </ul>
    </div>
</div>


