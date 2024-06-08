<!-- Modal -->
<div class="modal fade" id="update_status{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    حالة ونوع المستخدم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.update') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-group">
                        <label for="status">حالة المستخدم</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" selected disabled>--اختر من القائمة--</option>
                            <option value="1">مفعل</option>
                            <option value="0">غير مفعل</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">نوع المستخدم</label>
                        <select class="form-control" id="user_type" name="user_type" required>
                            <option value="" selected disabled>--اختر من القائمة--</option>
                            <option value="1">ادمن</option>
                            <option value="2">البائع</option>
                            <option value="3">الزبون</option>
                        </select>
                    </div>

                    <input type="hidden" name="id" value="{{ $user->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
