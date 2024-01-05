<div id="main" >
    {{$user->name}}
    <ul>
        @foreach($boards as $board)
        <li>
            /**
             * Renders a link to a board with htmx attributes.
             *
             * This link triggers an htmx request to load the board fragment with the given ID.
             * After the request is complete, the 'setDraggable()' JavaScript function is called.
             *
             * @param int $board->id The ID of the board.
             * @param string $board->name The name of the board.
             * @return string The HTML link element.
             */
            <a hx-target="#main" hx-get="/fragments/board/{{$board->id}}" hx-on::after-request="setDraggable()">{{$board->name}}</a>
        </li>
        @endforeach
    </ul>
</div>

