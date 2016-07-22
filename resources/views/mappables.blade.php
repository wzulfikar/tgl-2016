{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('mappable_id', 'Mappable_id:') !!}
			{!! Form::text('mappable_id') !!}
		</li>
		<li>
			{!! Form::label('mappable_type', 'Mappable_type:') !!}
			{!! Form::text('mappable_type') !!}
		</li>
		<li>
			{!! Form::label('lat', 'Lat:') !!}
			{!! Form::text('lat') !!}
		</li>
		<li>
			{!! Form::label('lng', 'Lng:') !!}
			{!! Form::text('lng') !!}
		</li>
		<li>
			{!! Form::label('user_id', 'User_id:') !!}
			{!! Form::text('user_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}