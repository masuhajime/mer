<h1>showing ranking</h1>

<ul>
@forelse($records as $record)
      <li>{{ $record->get('name') }} : {{ $record->get('score') }}</li>
@empty
      <li>No records</li>
@endforelse
</ul>