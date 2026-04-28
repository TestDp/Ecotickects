@if(count($ElementosArray["evento"]->camposPersonalizados) > 0)
<br/>
<div class="row row-narrow row-20">
    <div class="col-md-12">
        <h2 style="font-size: 20px; font-family: sans-serif; color:#2297e1;">Información adicional</h2>
    </div>
    @foreach($ElementosArray["evento"]->camposPersonalizados as $campo)
        <div class="col-md-6">
            <div class="form-wrap">
                <label>{{ $campo->etiqueta }} @if($campo->esObligatorio)<span style="color:red;">*</span>@endif</label>
                @if($campo->tieneOpciones())
                    <select name="campoPersonalizado[{{ $campo->id }}]" class="form-input campoPersonalizado" data-obligatorio="{{ $campo->esObligatorio ? '1' : '0' }}" data-etiqueta="{{ $campo->etiqueta }}">
                        <option value="">Seleccionar</option>
                        @foreach($campo->getOpcionesArray() as $opcion)
                            <option value="{{ $opcion }}">{{ $opcion }}</option>
                        @endforeach
                    </select>
                @else
                    <input name="campoPersonalizado[{{ $campo->id }}]" type="text" class="form-input campoPersonalizado" data-obligatorio="{{ $campo->esObligatorio ? '1' : '0' }}" data-etiqueta="{{ $campo->etiqueta }}"/>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endif
