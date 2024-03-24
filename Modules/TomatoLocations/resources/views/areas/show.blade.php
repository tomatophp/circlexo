<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.view')}} {{trans('tomato-locations::global.area.single')}} #{{$model->id}}</h1>

    <div class="flex flex-col space-y-4">

        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-bold">
                    {{trans('tomato-locations::global.area.city')}}
                </h3>
            </div>
            <div>
                <h3 class="text-lg">
                    {{ $model->city->name}}
                </h3>
            </div>
        </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-locations::global.area.name')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->name}}
                  </h3>
              </div>
          </div>


          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-locations::global.area.lat')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->lat}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-locations::global.area.lang')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->lang}}
                  </h3>
              </div>
          </div>

    </div>
</x-splade-modal>
