@foreach($data['candidateAchievements'] as $candidateAchievement)
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-achievement"
         data-referee-id="{{ $loop->index }}" data-id="{{ $candidateAchievement->id }}">
        <article class="article article-style-b">
            <div class="article-details border-0">
                <div class="article-title">
                    <h6 class="text-muted">{{ $candidateAchievement->title }}</h6>
                </div>

                <p class="mb-0">{{ $candidateAchievement->description }}</p>
                <div class="article-cta candidate-achievement-edit-delete">
                    <a href="javascript:void(0)" class="action-btn edit-achievement"
                       data-id="{{ $candidateAchievement->id }}"><i class="fa fa-edit p-1"></i></a>
                    <a href="javascript:void(0)" class="text-danger action-btn delete-achievement"
                       data-id="{{ $candidateAchievement->id }}"><i class="fa fa-trash p-1"></i></a>
                </div>
            </div>
        </article>
    </div>
@endforeach
