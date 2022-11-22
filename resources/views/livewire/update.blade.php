<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Staff edit</h5>
                <button type="button" class="close" wire:click.prevent="cancel()"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" id="firstname" placeholder="Enter firstname"
                            wire:model="firstname" required>
                        @error('firstname')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Enter lastname"
                            wire:model="lastname" required>
                        @error('lastname')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="phone" class="form-control" id="phone" placeholder="Enter phone" wire:model="phone" disabled>
                        @error('phone')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="form-label" for="role">Roles</label>
                            <select class="form-control" name="role" id="role" wire:model="role" required>
                                <option value="superadmin">SEO</option>
                                <option value="admin">Admin</option>
                                <option value="accounting">Accounting</option>
                                <option value="marketing">Marketing</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" wire:model="user_id">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password"
                            wire:model="password">
                        @error('password')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
       </div>
    </div>
</div>
