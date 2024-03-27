<x-splade-form :method="$method" :action="$action" :default="$default" {{ $attributes }}>
   <div class="flex flex-col space-y-4">
       @foreach($fields as $field)
           @if($field->is_reactive)
               <div v-if="form[@js($field->reactive_field)] === @js($field->reactive_where)">
                   @if($field->type === 'date')
                       <x-splade-input date :name="$field->name" :type="$field->type" :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
                   @elseif($field->type === 'datetime')
                       <x-splade-input date time :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
                   @elseif($field->type === 'time')
                       <x-splade-input  time :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
                   @elseif($field->type === 'color')
                       <x-tomato-admin-color :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
                   @elseif($field->type === 'file')
                       <x-splade-file filepond preview :multiple="$field->is_multi" :name="$field->name" :type="$field->type" :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
                   @elseif($field->type === 'checkbox')
                       <x-splade-checkbox :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
                   @elseif($field->type === 'radio')
                       <x-splade-radio :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>

                   @elseif($field->type === 'select')
                       @if($field->is_from_table)
                           <x-splade-select choices :multiple="$field->is_multi" :relation="$field->is_multi" :name="$field->name" :remote-url="$field->table_name" remote-root="{{$field->validation['option_root'] ?? 'data'}}" option-label="{{$field->validation['option_label'] ?? 'name'}}" option-value="{{$field->validation['option_value'] ?? 'id'}}" :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" />
                       @else
                       <x-splade-select choices :multiple="$field->is_multi" :name="$field->name" :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}">
                           @if($field->has_options)
                               @foreach($field->options as $option)
                                   <option value="{{$option['key']}}">{{$option['value_'.app()->getLocale()]}}</option>
                               @endforeach
                           @endif
                       </x-splade-select>
                       @endif
                   @elseif($field->type === 'password')
                       <x-splade-input  :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
                       <x-splade-input  name="{{$field->name.'_confirmation'}}" :type="$field->type"   placeholder="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name)) . ' Confirmation'}}" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name)) . ' Confirmation'}}" required="{{$field->is_required}}"/>
                   @elseif($field->type === 'textarea')
                       <x-splade-textarea  :name="$field->name" :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
                   @elseif(
                       $field->type === 'text' ||
                       $field->type === 'range' ||
                       $field->type === 'number' ||
                       $field->type === 'email' ||
                       $field->type === 'tel'
                   )
                       <x-splade-input :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" :label="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" required="{{$field->is_required}}"/>
                   @endif
               </div>

           @else
               @if($field->type === 'date')
                   <x-splade-input date :name="$field->name" :type="$field->type" :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
               @elseif($field->type === 'datetime')
                   <x-splade-input date time :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
               @elseif($field->type === 'time')
                   <x-splade-input time :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
               @elseif($field->type === 'file')
                   <x-splade-file filepond preview :multiple="$field->is_multi" :name="$field->name" :type="$field->type" :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
               @elseif($field->type === 'color')
                   <x-tomato-admin-color :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
               @elseif($field->type === 'checkbox')
                   <x-splade-checkbox :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
               @elseif($field->type === 'radio')
                   <x-splade-radio :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
               @elseif($field->type === 'select')
                   @if($field->is_from_table)
                       <x-splade-select choices :multiple="$field->is_multi" :relation="$field->is_multi" :name="$field->name" :remote-url="$field->table_name" remote-root="{{$field->validation['option_root'] ?? 'data'}}" option-label="{{$field->validation['option_label'] ?? 'name'}}" option-value="{{$field->validation['option_value'] ?? 'id'}}" :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}"  />
                   @else
                       <x-splade-select choices :multiple="$field->is_multi" :name="$field->name" :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}">
                           @if($field->has_options)
                               @foreach($field->options as $option)
                                   <option value="{{$option['key']}}">{{$option['value_'.app()->getLocale()]}}</option>
                               @endforeach
                           @endif
                       </x-splade-select>
                   @endif
               @elseif($field->type === 'password')
                   <x-splade-input :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
                   <x-splade-input name="{{$field->name.'_confirmation'}}" :type="$field->type"   placeholder="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name)) . ' Confirmation'}}" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name)) . ' Confirmation'}}" required="{{$field->is_required}}"/>
               @elseif($field->type === 'textarea')
                   <x-splade-textarea :name="$field->name" :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
               @elseif($field->type === 'rich')
                   <x-tomato-admin-rich :name="$field->name" :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" label="{{$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))}}" required="{{$field->is_required}}"/>
               @elseif(
                   $field->type === 'text' ||
                   $field->type === 'number' ||
                   $field->type === 'range' ||
                   $field->type === 'email' ||
                   $field->type === 'tel'
               )
                   <x-splade-input :name="$field->name" :type="$field->type"   :placeholder="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" :label="$field->label && !empty($field->label) ? $field->label :  ucfirst(str_replace('_',' ',$field->name))" required="{{$field->is_required}}"/>
               @endif
           @endif
       @endforeach
   </div>


    <x-tomato-admin-submit class="my-4"  :label="__('Submit')" />
</x-splade-form>
