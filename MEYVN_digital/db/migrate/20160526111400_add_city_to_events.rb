class AddCityToEvents < ActiveRecord::Migration[5.0]
  def change
    add_reference :events, :city, foreign_key: true
  end
end
