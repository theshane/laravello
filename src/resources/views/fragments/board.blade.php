<div>
    <h1 class="text-2xl font-bold">{{$board->name}}</h1>

    <div class="flex">
        @foreach($statuses as $status)
            <div class="w-1/4 p-4 border droppable" id="status-{{$status->id}}-col" data-status-id="{{$status->id}}" droppable="true"  hx-get="/fragments/board/{{$board->id}}" hx-target="#main"  hx-trigger="card-moved from:body">
                <h2 class="text-lg font-semibold">{{$status->name}}</h2>
                @foreach($board->cards()->where("status", $status->id)->orderBy("order")->get() as $card)
                    <div class="mt-4 p-2 border rounded draggable" draggable="true" data-card-id="{{$card->id}}">
                        <div class="flex justify-between">
                            <div class="font-semibold">{{$card->title}}</div>
                            <div class="text-sm text-gray-500">{{$card->created_at}}</div>
                        </div>
                    </div>
                @endforeach
                @if($status->name === 'To Do')
                    <div class="mt-4">
                        @if($add_card)
                        <form hx-post="/board/{{$board->id}}/card" hx-target="#main">
                        @csrf
                        <textarea class="w-full border p-2 rounded" placeholder="Add a new card" name="title"></textarea>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Card
                        </button>
                        @endif
                        @if(!$add_card)
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" hx-trigger="click" hx-get="/fragments/board/{{$board->id}}?add_card=true" hx-target="#main">
                            Add New Card
                        </button>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
    
</div>