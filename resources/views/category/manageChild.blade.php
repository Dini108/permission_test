<ul>

    @foreach($childs as $child)

        <li data-id="{{ $child->id }}" class="child">

            <span class="title">{{ $child->title }}</span>

            @if(count($child->childs))

                @include('category.manageChild',['childs' => $child->childs])

            @endif

        </li>

    @endforeach

</ul>
