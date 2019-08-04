{{ csrf_field() }}
<div class="form-group">
    <label for="question"> Question  </label>
    <span style="color: red"> * </span>
    <input type="text" class="form-control" id="question" name="question" placeholder="Enter Question" value="{{ $question->Question}}">
</div>

<div class="form-row">
    <div class="form-group col-md-5">
        <label for="option1"> Option 1 </label>
        <span style="color: red"> * </span>
        <input type="text" class="form-control" id="option1" name="option1" placeholder="Enter First Option" value="{{ $question->Option1}}">
    </div>


    <div class="form-group col-md-5">
        <label for="option2"> Option 2  </label>
        <span style="color: red"> * </span>
        <input type="text" class="form-control" id="option2" name="option2" placeholder="Enter Second Option" value="{{ $question->Option2}}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-5">
        <label for="option3"> Option 3 </label>
        <span style="color: red"> * </span>
        <input type="text" class="form-control" id="option3" name="option3" placeholder="Enter Third Option" value="{{ $question->Option3}}">
    </div>


    <div class="form-group col-md-5">
        <label for="option4"> Option 4 </label>
        <span style="color: red"> * </span>
        <input type="text" class="form-control" id="option4" name="option4" placeholder="Enter Fourth Option" value="{{ $question->Option4 }}">
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
            <option value="1" {{ $question->Correct_Answer == 1 ? 'selected' : '' }}> 1 </option>
            <option value="2" {{ $question->Correct_Answer == 2 ? 'selected' : '' }}> 2 </option>
            <option value="3" {{ $question->Correct_Answer == 3 ? 'selected' : '' }}> 3 </option>
            <option value="4" {{ $question->Correct_Answer == 4 ? 'selected' : '' }}> 4 </option>

        </select>
    </div>


    <div class="form-group col-md-6">
        <label for="marks"> Marks </label>
        <span style="color: red"> * </span>

        <select class="form-control" id="marks" name="marks">
            <option  style="display:none" disabled selected value> Select Marks for this question </option>
            <option value="0.5" {{ $question->Marks == 0.5 ? 'selected' : '' }}> 0.5 </option>
            <option value="1" {{ $question->Marks == 1 ? 'selected' : '' }}> 1 </option>
            <option value="1.5" {{ $question->Marks == 1.5 ? 'selected' : '' }}> 1.5 </option>
            <option value="2" {{ $question->Marks == 2 ? 'selected' : '' }}> 2 </option>
            <option value="2.5" {{ $question->Marks == 2.5 ? 'selected' : '' }}> 2.5 </option>
            <option value="3" {{ $question->Marks == 3 ? 'selected' : '' }}> 3 </option>
            <option value="3.5" {{ $question->Marks == 3.5 ? 'selected' : '' }}> 3.5 </option>
            <option value="4" {{ $question->Marks == 4 ? 'selected' : '' }}> 4 </option>
            <option value="4.5" {{ $question->Marks == 4.5 ? 'selected' : '' }}> 4.5 </option>
            <option value="5" {{ $question->Marks == 5 ? 'selected' : '' }}> 5 </option>
        </select>

    </div>
</div>
<div class="form-row">
    <div class="col-md-4">
        <input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="UPDATE QUESTION">
    </div>
  {{--  @if(isset($questions))--}}
        <div class="col-md-4 ml-auto">
            <a class="btn btn-danger" id="btn-delete" href="{{route('question_delete', [$question->id])}}"> Delete </a>
        </div>
{{--@endif--}}
</div>

</form>