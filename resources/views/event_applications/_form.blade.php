<div class="form-group">
  <input type="text" name="price" value="{{ old('price') ? old('price') : @$event_application->price }}" class="form-control money" placeholder="* Preço" required>
</div>

<div class="overflow-hidden pt-4">
  <button type="submit" class="btn btn-dark px-5 float-right btn-submit">Salvar</button>
</div>