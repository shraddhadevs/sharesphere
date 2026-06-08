<form action="submit_ngo.php" method="POST" class="card p-4 shadow-sm">
    <h4 class="mb-3">suggest NGO  (Suggest an NGO)</h4>
    <div class="mb-3">
        <label>ngo name:</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>short information :</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>Website Link:</label>
        <input type="url" name="website_url" class="form-control" placeholder="https://...">
    </div>
    <button type="submit" class="btn btn-primary">submit</button>
</form>