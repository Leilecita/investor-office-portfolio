<div class="columns is-mobile is-multiline" x-data="{ instrumentos_{{ $checkbox_name }}: false }">
  <div class="column is-12-mobile is-4-tablet">
    <div class="field">
      <input class="is-checkradio has-background-color is-white" type="checkbox" name="instrumentos_{{ $checkbox_name }}_checkbox"
        x-model="instrumentos_{{ $checkbox_name }}" id="instrumentos_{{ $checkbox_name }}_checkbox">
      <label for="instrumentos_{{ $checkbox_name }}_checkbox" class="field">{{ $checkbox_proper_name }}</label>
    </div>
  </div>
  <div class="column is-6-mobile is-4-tablet" x-bind:class="instrumentos_{{ $checkbox_name }} ? '' : 'is-hidden-mobile';">
    <div class="field">
      <div class="select">
        <label for="instrumentos_{{ $checkbox_name }}_conocimiento" class="label is-hidden-tablet">Conocimiento</label>
        <select x-bind:disabled="!instrumentos_{{ $checkbox_name }}" x-bind:required="instrumentos_{{ $checkbox_name }}"
          name="instrumentos_{{ $checkbox_name }}_conocimiento">
          <option>Limitado</option>
          <option>Moderado</option>
          <option>Extensivo</option>
        </select>
      </div>
    </div>
  </div>
  <div class="column is-6-mobile is-4-tablet" x-bind:class="instrumentos_{{ $checkbox_name }} ? '' : 'is-hidden-mobile';">
    <div class="field">
      <div class="control">
        <label for="instrumentos_{{ $checkbox_name }}_anio" class="label is-hidden-tablet">Desde qué año</label>
        <input type="number" class="input" x-bind:disabled="!instrumentos_{{ $checkbox_name }}"
          x-bind:required="instrumentos_{{ $checkbox_name }}" name="instrumentos_{{ $checkbox_name }}_anio" pattern="[0-9]{4}" min="1901"
          max="2050" placeholder="AAAA">
      </div>
    </div>
  </div>
</div>