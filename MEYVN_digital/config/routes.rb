Rails.application.routes.draw do
  root to: 'welcome#index'

  devise_for :users
  resources :users do
    resources :filters
  end

  resources :events do
    resources :discussions, only: [:create, :new, :delete, :update, :show]
  end
end
