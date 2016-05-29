class DiscussionsController < ApplicationController
  def show
    event = Event.find(params[:event_id])
    @discussion = event.discussions.to_a[params[:id].to_i - 1]
  end

  def new
    @discussion = Discussion.new
  end

  def create
    @event = Event.find(params[:event_id])

    if @event.discussions.create(discussion_create_params)
      flash[:info] = 'new discussion created!'
      redirect_to event_path(Event.find(params[:event_id]))
    else
      flash[:danger] = "Can't create discussion!"
    end
  end

  private
  def discussion_create_params
    params.require(:discussion).permit(:topic)
  end
end
