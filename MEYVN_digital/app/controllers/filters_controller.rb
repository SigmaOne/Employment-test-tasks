class FiltersController < ApplicationController
  def index
    @user = User.find(params[:user_id])
  end

  def new
    @filter = Filter.new
  end

  def create
    @user = User.find(params[:user_id])
    @filter = @user.saved_filters.create(create_filter_params)

    if @filter.errors.empty?
      flash[:info] = 'New filter created!'
      redirect_to user_filters_path(@user)
    else
      render 'new'
    end
  end

  private
  def create_filter_params
    params.require(:filter).permit(:name, :event_name, :city_id, :start_date, :end_date)
  end
end
