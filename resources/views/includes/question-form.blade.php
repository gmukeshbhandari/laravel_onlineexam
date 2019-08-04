{{ csrf_field() }}
<div class="form-group">
    <label for="question"> Question  </label>
    <span style="color: red"> * </span>
    <input type="text" class="form-control" id="question" name="question" placeholder="Enter Question" value="{{ old('question')}}">
</div>

<div class="form-row">
    <div class="form-group col-md-5">
        <label for="option1"> Option 1 </label>
        <span style="color: red"> * </span>
        <input type="text" class="form-control" id="option1" name="option1" placeholder="Enter First Option" value="{{ old('option1')}}">
    </div>


    <div class="form-group col-md-5">
        <label for="option2"> Option 2  </label>
        <span style="color: red"> * </span>
        <input type="text" class="form-control" id="option2" name="option2" placeholder="Enter Second Option" value="{{ old('option2')}}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-5">
        <label for="option3"> Option 3 </label>
        <span style="color: red"> * </span>
        <input type="text" class="form-control" id="option3" name="option3" placeholder="Enter Third Option" value="{{ old('option3')}}">
    </div>


    <div class="form-group col-md-5">
        <label for="option4"> Option 4 </label>
        <span style="color: red"> * </span>
        <input type="text" class="form-control" id="option4" name="option4" placeholder="Enter Fourth Option" value="{{ old('option4') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="correctanswer"> Correct Answer </label>
        <span style="color: red"> * </span>
        <select class="form-control" id="correctanswer" name="correctanswer">
            @php
            $answerlists = array(1,2,3,4);
            @endphp
            <option style="display:none" disabled selected value> Which Option is correct? </option>
                <option value="1" {{ old('correctanswer') == 1 ? 'selected' : '' }}> 1 </option>
                <option value="2" {{ old('correctanswer') == 2 ? 'selected' : '' }}> 2 </option>
                <option value="3" {{ old('correctanswer') == 3 ? 'selected' : '' }}> 3 </option>
                <option value="4" {{ old('correctanswer') == 4 ? 'selected' : '' }}> 4 </option>

        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="marks"> Marks </label>
        <span style="color: red"> * </span>

        <select class="form-control" id="marks" name="marks">
            <option  style="display:none" disabled selected value> Select Marks for this question </option>
            <option value="0.5" {{ old('marks') == 0.5 ? 'selected' : '' }}> 0.5 </option>
            <option value="1" {{ old('marks') == 1 ? 'selected' : '' }}> 1 </option>
            <option value="1.5" {{ old('marks') == 1.5 ? 'selected' : '' }}> 1.5 </option>
            <option value="2" {{ old('marks') == 2 ? 'selected' : '' }}> 2 </option>
            <option value="2.5" {{ old('marks') == 2.5 ? 'selected' : '' }}> 2.5 </option>
            <option value="3" {{ old('marks') == 3 ? 'selected' : '' }}> 3 </option>
            <option value="3.5" {{ old('marks') == 3.5 ? 'selected' : '' }}> 3.5 </option>
            <option value="4" {{ old('marks') == 4 ? 'selected' : '' }}> 4 </option>
            <option value="4.5" {{ old('marks') == 4.5 ? 'selected' : '' }}> 4.5 </option>
            <option value="5" {{ old('marks') == 5 ? 'selected' : '' }}> 5 </option>
        </select>

    </div>
</div>
<div class="form-row">
<div class="col-md-4">
<input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="ADD QUESTION">
</div>

</form>