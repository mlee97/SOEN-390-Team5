
<select id="user_type" name="user_type" class="form-control" required>
    <option value="">-- SELECT USER TYPE --</option>
    <option value="0" @if(isset($user) && $user->user_type ==0) selected @endif>IT Department</option>
    <option value="3" @if(isset($user) && $user->user_type ==3) selected @endif>Shipping Department</option>
    <option value="4" @if(isset($user) && $user->user_type ==4) selected @endif>Inventory</option>
    <option value="5" @if(isset($user) && $user->user_type ==5) selected @endif>Manufacturer Worker</option>
    <option value="6" @if(isset($user) && $user->user_type ==6) selected @endif>Accountant</option>
    <option value="7" @if(isset($user) && $user->user_type ==7) selected @endif>Product Manager</option>
    <option value="8" @if(isset($user) && $user->user_type ==8) selected @endif>Sales Worker</option>
    <option value="9" @if(isset($user) && $user->user_type ==9) selected @endif>Quality Control</option>

</select>
