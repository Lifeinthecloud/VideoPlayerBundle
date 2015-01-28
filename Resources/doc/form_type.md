The video Form Type
======================

LITCVideoPlayerBundle provides a convenient video form type, named ``litc_video_type``.
It appears as a text input, accepts url and convert them to a Video instance.

## How to use

# Step 1: From a controller file

``` php 
use LITC\VideoPlayerBundle\Form\VideoType;

class MyController extends AbstractAdminController
{
    public function myAction(FormBuilderInterface $builder, array $options)
    {
        $formVideo = $this->createForm(new VideoType(), $video);

        return $this->render(
            'formVideo' => $formVideo->createView(),
        ));
    }
```

# Step 2: From a view file

``` yml
<form action="{{path('litc_medias_video_add')}}" method="post" {{ form_enctype(formVideo) }} role="form">
    {{ form_widget(formVideo._token) }}

    {{ form_label(formVideo.url) }}
    {{ form_errors(formVideo.url) }}
    {{ form_widget(formVideo.url) }}

    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
```
