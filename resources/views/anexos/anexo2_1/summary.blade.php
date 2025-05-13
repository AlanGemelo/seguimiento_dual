@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Resumen de la Evaluación</h3>
    <p><strong>Unidad Económica:</strong> {{ $request->unidad_economica }}</p>
    <p><strong>Periodo Escolar:</strong> {{ $request->periodo_escolar }}</p>
    <p><strong>Fecha de Aplicación:</strong> {{ $request->fecha_aplicacion }}</p>

    <h4>Sección 1 - Situación Legal</h4>
    @foreach ($request->seccion1 as $key => $value)
        <p>Pregunta {{ $key + 1 }}: {{ $value == 1 ? 'No' : 'Sí' }}</p>
    @endforeach

    <h4>Sección 2 - Situación Educativa/Formativa</h4>
    @foreach ($request->seccion2 as $key => $value)
        <p>Pregunta {{ $key + 1 }}:
            @if ($value == 1)
                No Cumple
            @elseif ($value == 2)
                Socialmente
            @else
                Cumple
            @endif
        </p>
    @endforeach

    <h4>Sección 3 - Factores Socioeconómicos</h4>
    @foreach ($request->seccion3 as $key => $value)
        <p>Pregunta {{ $key + 1 }}:
            @if ($value == 1)
                No Cumple
            @elseif ($value == 2)
                Socialmente
            @else
                Cumple
            @endif
        </p>
    @endforeach

    <h4>Resultado Final</h4>
    <p><strong>Promedio Final:</strong> {{ $promedio_final }}%</p>
    <p><strong>Interpretación:</strong> {{ $interpretacion }}</p>

    <a href="{{ route('anexo2_1.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
