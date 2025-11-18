@extends('layouts.app')

@section('content')
@if ($errors->any())
<div>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

@if (\Session::has('success'))
<div>
  <p>{{ \Session::get('success') }}</p>
</div>
@endif

<form method="post" action="{{ route('forms.store') }}" class="form p-4" x-data="{ 
    paso: 1, 
    fecha_nacimiento: ''
  }" x-ref="form">
  {{csrf_field()}}
  <h2 class="titulo title is-4">Apertura de cuenta pershing</h2>
  <template x-if="paso >= 1">
    <div class="paso">
      <h4 class="titulo-info title is-5">Información personal</h4>

      <div class="columns">
        <div class="column">
          <div class="field">
            <label class="label" for="nombre">Nombre(s)</label>
            <p class="control has-icons-left">
              <input required type="text" class="input" name="nombre" maxlength="127">
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="apellido">Apellido(s)</label>
            <p class="control has-icons-left">
              <input required type="text" class="input" name="apellido" maxlength="127">
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
            </p>
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="column">
          <div class="field">
            <label class="label" for="tel_casa">Teléfono casa</label>
            <p class="control has-icons-left">
              <input required type="tel" class="input" name="tel_casa" maxlength="24">
              <span class="icon is-small is-left">
                <i class="fa fa-phone"></i>
              </span>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="celular">Celular</label>
            <p class="control has-icons-left">
              <input required class="input" type="tel" name="celular" maxlength="24">
              <span class="icon is-small is-left">
                <i class="fas fa-mobile"></i>
              </span>
            </p>
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="column">
          <div class="field">
            <label class="label" for="email">Correo electrónico</label>
            <p class="control has-icons-left">
              <input required class="input" type="email" name="email" maxlength="127">
              <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
              </span>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="direccion">Dirección legal</label>
            <p class="control has-icons-left">
              <input required type="text" class="input" name="direccion" maxlength="255">
              <span class="icon is-small is-left">
                <i class="fas fa-home"></i>
              </span>
            </p>
          </div>
        </div>
      </div>

      <div class="columns">
        <div class="column is-one-quarter">
          <div class="field">
            <label class="label" for="fecha_nacimiento">Fecha nacimiento</label>
            <p class="control has-icons-left">
              <input required class="input" type="date" name="fecha_nacimiento" x-model="fecha_nacimiento" min="1901-01-01">
              <span class="icon is-small is-left">
                <i class="fa fa-calendar"></i>
              </span>
            </p>
          </div>
        </div>
        <div class="column">
          @include('components.country_select', ['select_name' => 'pais_nacimiento', 'select_proper_name' => 'País de
          nacimiento'])
        </div>

        <div class="column">
          @include('components.country_select', ['select_name' => 'ciudadania', 'select_proper_name' => 'Ciudadanía'])
        </div>
      </div>
      <div class="columns">
        <div class="column is-one-quarter">
          <div class="field">
            <label class=" label" for="tipo_documento">Tipo de documento</label>
            <div class="select">
              <select required name="tipo_documento">
                <option hidden disabled selected value></option>
                <option>Pasaporte</option>
                <option>DNI</option>
              </select>
            </div>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="pasaporte_dni">Número de documento</label>
            <p class="control has-icons-left">
              <input required type="text" class="input"  name="pasaporte_dni" maxlength="16">
              <span class="icon is-small is-left">
                <i class="fa fa-address-card"></i>
              </span>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="cuit">CUIT</label>
            <p class="control has-icons-left">
              <input required type="text" class="input" placeholder="Foreing TIN" name="cuit" maxlength="16">
              <span class="icon is-small is-left">
                <i class="fa fa-address-card"></i>
              </span>
            </p>
          </div>
        </div>
      </div>

      <div class="columns" x-data="{ estado_civil: '' }">
        <div class="column is-one-quarter">
          <div class="field">
            <label class="label" for="estado_civil">Estado civil</label>
            <div class="select">
              <select name="estado_civil" x-model="estado_civil" required>
                <option hidden disabled selected value></option>
                <option value="soltero">Soltero/a</option>
                <option value="casado">Casado/a</option>
              </select>
            </div>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <div class="control">
              <label class="label" for="nombre_pareja">Nombre y apellido pareja</label>
              <input :required="estado_civil === 'casado'" type="text" class="input" name="nombre_pareja"
                :disabled="estado_civil !== 'casado'" maxlength="255">
            </div>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="hijos_dependientes">Nº hijos dependientes</label>
            <p class="control has-icons-left">
              <input required type="number" class="input" name="hijos_dependientes" min="0" max="30">
              <span class="icon is-small is-left">
                <i class="fas fa-users"></i>
              </span>
            </p>
          </div>
        </div>
      </div>
      <template ref="contacto_confianza"
        x-if="Math.floor((new Date() - new Date(fecha_nacimiento).getTime()) / 3.15576e+10) > 65">
        <div>
          <h4 class="titulo-info title is-5">Contacto de confianza</h4>
          <div class="columns">
            <div class="column">
              <div class="field">
                <label class="label" for="nombre_contacto">Nombre(s) y apellido(s)</label>
                <p class="control has-icons-left">
                  <input class="input" type="text" name="nombre_contacto" required maxlength="255">

                  <span class="icon is-small is-left">
                    <i class="fa fa-user"></i>
                  </span>
                </p>
              </div>
            </div>
            <div class="column">
              <div class="field">
                <label class="label" for="nacimiento_contacto">Fecha de nacimiento</label>
                <p class="control has-icons-left">
                  <input class="input" type="date" name="nacmiento_contacto" required min="1901-01-01">
                  <span class="icon is-small is-left">
                    <i class="fa fa-calendar"></i>
                  </span>
                </p>
              </div>
            </div>
          </div>
          <div class="columns">
            <div class="column">
              <div class="field">
                <label class="label" for="tel_contacto">Teléfono</label>
                <p class="control has-icons-left">
                  <input class="input" type="tel"  name="tel_contacto" required maxlength="24">
                  <span class="icon is-small is-left">
                    <i class="fas fa-phone"></i>
                  </span>
                </p>
              </div>
            </div>
            <div class="column">
              <div class="field">
                <label class="label" for="email_contacto">Correo electrónico</label>
                <p class="control has-icons-left">
                  <input class="input" type="email"  name="email_contacto" required maxlength="127">
                  <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                  </span>
                </p>
              </div>
            </div>
          </div>
          <div class="columns">
            <div class="column">
              <div class="field">
                <label class="label" for="direccion_contacto">Dirección de correspondencia</label>
                <p class="control has-icons-left">
                  <input class="input" type="text"  name="direccion_contacto" required>
                  <span class="icon is-small is-left" maxlength="255">
                    <i class="fas fa-home"></i>
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </template>
    </div>
  </template>

  <template x-if="paso >= 2">
    <div class="paso">
      <h4 class="titulo-info title is-5">Información de empleo</h4>
      <div class="columns">
        <div class="column">
          <div class="field">
            <div class="control">
              <label class="label" for="ocupacion">Ocupación</label>
              <input required type="text" class="input"  name="ocupacion" maxlength="127">
            </div>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <div class="control">
              <label class="label" for="tipo_negocio">Tipo de negocio</label>
              <input required type="text" class="input"  name="tipo_negocio" maxlength="127">
            </div>
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="column">
          <div class="field">
            <label class="label" for="nombre_empresa">Nombre de la empresa</label>
            <p class="control has-icons-left">
              <input required class="input" type="text"  name="nombre_empresa" maxlength="127">
              <span class="icon is-small is-left">
                <i class="far fa-building"></i>
              </span>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="anios_empleo">Años de empleo</label>

            <p class="control has-icons-left">
              <input required class="input" type="number"  name="anios_empleo" min="0" max="100">
              <span class="icon is-small is-left">
                <i class="far fa-calendar"></i>
              </span>
            </p>
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="column">
          <div class="field">
            <label class="label" for="direccion_empresa">Dirección de la empresa</label>
            <p class="control has-icons-left">
              <input required class="input" type="text"  name="direccion_empresa" maxlength="255">
              <span class="icon is-small is-left">
                <i class="fas fa-building"></i>
              </span>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="telefono_empresa">Teléfono de la empresa</label>
            <p class="control has-icons-left">
              <input required class="input" type="tel" name="telefono_empresa" maxlength="24">
              <span class="icon is-small is-left">
                <i class=" 	fas fa-phone"></i>
              </span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </template>

  <template x-if="paso >= 3">
    <div class="paso">
      <h4 class="titulo-info title is-5">Información financiera</h4>
      <p class="subtitle is-6">Todos los montos son expresados en dólares estadounidenses (USD)</p>
      <div class="columns">
        <div class="column">
          <div class="field">
            <label class="label" for="ingreso_anual">Ingreso anual</label>
            <p class="control has-icons-left">
              <input required class="input" type="number" name="ingreso_anual">
              <span class="icon is-small is-left">
                <i class="fas fa-dollar-sign"></i>
              </span>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="patrimonio">Patrimonio</label>
            <p class="control has-icons-left">
              <input required class="input" type="number" name="patrimonio">
              <span class="icon is-small is-left">
                <i class="fas fa-hand-holding-usd"></i>
              </span>
            </p>
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="column">
          <div class="field">
            <label class="label" for="liquidez">Liquidez</label>
            <p class="control has-icons-left">
              <input required class="input" type="number" name="liquidez">
              <span class="icon is-small is-left">
                <i class="fas fa-money-bill"></i>
              </span>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="monto_inicial_cuenta">¿Cuál es el monto inicial de la cuenta?</label>
            <p class="control has-icons-left">
              <input required class="input" type="number" name="monto_inicial_cuenta" min="0">
              <span class="icon is-small is-left">
                <i class="fas fa-wallet"></i>
              </span>
            </p>
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="column">
          <div class="field">
            <label class="label" for="fondeo_cuenta">¿Cómo se va a fondear la cuenta?
            </label>
            <p class="control">
              <input required class="input" type="text" name="fondeo_cuenta" maxlength="127">
            <p class="help">Transferencia, ACAT, etc.</p>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="banco_fondos">¿De qué banco provienen los fondos? </label>
            <p class="control has-icons-left">
              <input required class="input" type="text" name="banco_fondos" maxlength="127">
              <span class="icon is-small is-left">
                <i class="fas fa-landmark"></i>
              </span>
            </p>
          </div>
        </div>
      </div>






      <div class="columns" x-data="{ checkboxSi: false }">

        <div class="column">
          <label class="label" for="otros_movimientos">¿Va a tener otros movimientos aparte de los del
            mercado? </label>
          <div class="columns" x-data="{otros_movimientos: 'no'}">
            <div class="column is-3">
              <div class="control">
                <label class="radio">
                  <input x-model="otros_movimientos" type="radio" value="si" name="otros_movimientos">
                  Sí
                </label>
                <label class="radio">
                  <input x-model="otros_movimientos" type="radio" value="no" name="otros_movimientos">
                  No
                </label>
              </div>
            </div>
            <div class="column">
              <div class="field">
                <input class="input" x-bind:disabled="otros_movimientos === 'no'"
                  x-bind:required="otros_movimientos === 'si'" type="text" name="otros_movimientos_texto"
                  maxlength="255">
                <p class="help">Por ej. transferencias, compras, etc.</p>
              </div>
            </div>
          </div>

        </div>

        <div class="column">
          <div class="field">
            <label class="label">¿Qué tipo de activos va a manejar la cuenta?</label>

            <p class="control">
              <label class="checkbox">
                <input type="checkbox" name="activos_acciones">
                Acciones
              </label>
              <label class="checkbox">
                <input type="checkbox" name="activos_bonos">
                Bonos
              </label>
              <label class="checkbox">
                <input type="checkbox" name="activos_fondos">
                Fondos
              </label>
              <label class="checkbox">
                <input type="checkbox" name="activos_opciones">
                Opciones
              </label>
              <label class="checkbox">
                <input type="checkbox" name="activos_otros">
                Otros
              </label>
            </p>
          </div>

        </div>
      </div>
    </div>
  </template>

  <template x-if="paso >= 4">
    <div class="paso">
      <h4 class="titulo-info title is-5">Inversiones</h4>
      <div class="columns is-mobile">
        <div class="column is-12-mobile is-4-tablet">
          <div class="field">
            <label class=" label">Tipo de instrumento</label>
          </div>
        </div>
        <div class=" column is-4-tablet is-hidden-mobile">
          <div class="field">
            <label class=" label">Conocimiento y experiencia en inversiones</label>
          </div>
        </div>
        <div class="column is-4-tablet is-hidden-mobile">
          <div class="field">
            <label class=" label">Desde qué año</label>
          </div>
        </div>
      </div>

      @include('components.instrumentos', ['checkbox_name' => 'annuities_v', 'checkbox_proper_name' => 'Annuities
      variable'])
      @include('components.instrumentos', ['checkbox_name' => 'commodities', 'checkbox_proper_name' => 'Commodities and
      futures'])
      @include('components.instrumentos', ['checkbox_name' => 'equities', 'checkbox_proper_name' => 'Equities'])
      @include('components.instrumentos', ['checkbox_name' => 'exchange', 'checkbox_proper_name' => 'Exchange traded
      funds'])
      @include('components.instrumentos', ['checkbox_name' => 'fixed_income', 'checkbox_proper_name' => 'Fixed income'])
      @include('components.instrumentos', ['checkbox_name' => 'insurance', 'checkbox_proper_name' => 'Insurance'])
      @include('components.instrumentos', ['checkbox_name' => 'mutual_funds', 'checkbox_proper_name' => 'Mutual funds'])
      @include('components.instrumentos', ['checkbox_name' => 'options', 'checkbox_proper_name' => 'Options'])
      @include('components.instrumentos', ['checkbox_name' => 'precious_metals', 'checkbox_proper_name' => 'Precious
      metals'])
      @include('components.instrumentos', ['checkbox_name' => 'real_estate', 'checkbox_proper_name' => 'Real estate'])
      @include('components.instrumentos', ['checkbox_name' => 'unit_investments_trust', 'checkbox_proper_name' => 'Unit
      investments trust'])
      @include('components.instrumentos', ['checkbox_name' => 'other', 'checkbox_proper_name' => 'Other'])


      <div class="columns" x-data="{ cuenta_otro_banco: 'no' }">
        <div class="column is-half">
          <label class="label" for="cuenta_otro_banco">¿Mantiene una cuenta de inversión en otro banco?</label>
          <div class="columns" x-data="{cuenta_otro_banco: 'no'}">
            <div class="column is-3">
              <div class="control">
                <label class="radio">
                  <input x-model="cuenta_otro_banco" type="radio" value="si" name="cuenta_otro_banco">
                  Sí
                </label>
                <label class="radio">
                  <input x-model="cuenta_otro_banco" type="radio" value="no" name="cuenta_otro_banco">
                  No
                </label>
              </div>
            </div>
            <div class="column is-6">
              <div class="field">
                <input class="input" x-bind:disabled="cuenta_otro_banco === 'no'"
                  x-bind:required="cuenta_otro_banco === 'si'" type="number" name="cuenta_otro_banco_anios" min="0"
                  max="100">
                <p class="help">¿Hace cuántos años?</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr class="line">
      <h4 class="titulo-info title is-5">Objetivos y detalles de inversión de la cuenta</h4>
      <div class="columns">

        <div class="column">
          <div class="field">
            <label class="label" for="riesgo_exposicion">Riesgo de exposición</label>
          </div>
          <div class="field">
            <div class="select">
              <select name="riesgo_exposicion">
                <option value="bajo">Bajo</option>
                <option value="moderado">Moderado</option>
                <option value="especulacion">Especulación</option>
                <option value="alto riesgo">Alto riesgo</option>
              </select>
            </div>
          </div>

        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="objetivo_inversion">Objetivos de inversión</label>
          </div>
          <div class="field">
            <input class="is-checkradio has-background-color is-white" id="checkboxIngresos" type="checkbox"
              name="checkboxIngresos">
            <label for="checkboxIngresos">Ingresos</label>
          </div>
          <div class="field">
            <input class="is-checkradio has-background-color is-white" id="checkboxCrecimiento" type="checkbox"
              name="checkboxCrecimiento">
            <label for="checkboxCrecimiento">Crecimiento a largo plazo</label>
          </div>
          <div class="field">
            <input class="is-checkradio has-background-color is-white" id="checkboxCortoPlazo" type="checkbox"
              name="checkboxCortoPlazo">
            <label for="checkboxCortoPlazo">Crecimiento a corto plazo</label>
          </div>
        </div>


        <div class="column">
          <div class="field">
            <label class="label" for="liquidez">Necesidad de liquidez</label>
          </div>
          <div class="field">
            <div class="select">
              <select name="liquidez">
                <option value="alta">Alta</option>
                <option value="media">Media</option>
                <option value="baja">Baja</option>
              </select>
            </div>
          </div>
        </div>

      </div>
      <div class="columns">
        <div class="column">
          <div class="field">
            <label class="label" for="pep">¿Es una Persona Políticamente Expuesta?</label>
            <div class="control">
              <label class="radio">
                <input type="radio" value="si" name="pep">
                Sí
              </label>
              <label class="radio">
                <input type="radio" value="no" name="pep" checked>
                No
              </label>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="field">
            <label class="label" for="horizonte_temporal">Horizonte temporal</label>
            <p class="control">
              <input required class="input" type="text" name="horizonte_temporal" maxlength="127">
              <p class="help">¿Cuánto tiempo tiene pensado mantener la inversión?</p>
            </p>
          </div>
        </div>
      </div>
    </div>
  </template>

  <div class="buttons mt-4 is-right">
    <input x-show="paso < 4"
      @click.prevent="$refs.form.checkValidity() ? paso += 1 : paso += 1; $refs.form.reportValidity();" type="submit"
      class="button is-info" value="Siguiente">
    <input x-show="paso >= 4" type="submit"
      @click.prevent="$refs.form.checkValidity() ? $refs.form.submit() : $refs.form.reportValidity();"
      class="button is-success" value="Guardar">
  </div>
</form>

@endsection